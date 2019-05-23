<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\EntryPoint\Updater;

use function Amp\call;
use Amp\Loop;
use Amp\Promise;
use Amp\Success;
use Psr\Log\LoggerInterface;
use ServiceBus\Mutex\MutexFactory;
use ServiceBus\TelegramBot\Api\Method\GetUpdates;
use ServiceBus\TelegramBot\Api\Method\WebHook\DeleteWebhook;
use ServiceBus\TelegramBot\EntryPoint\Configuration\EntryPointConfig;
use ServiceBus\TelegramBot\EntryPoint\Configuration\LongPoolingConfig;
use ServiceBus\TelegramBot\EntryPoint\TelegramUpdateDispatcher;
use ServiceBus\TelegramBot\Interaction\InteractionsProvider;
use ServiceBus\TelegramBot\Interaction\Result\Fail;
use ServiceBus\TelegramBot\TelegramCredentials;

/**
 * @internal
 */
final class LongPoolingUpdater implements Updater
{
    /**
     * @var TelegramUpdateDispatcher
     */
    private $updateDispatcher;

    /**
     * @var MutexFactory
     */
    private $mutexFactory;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * Watcher id.
     *
     * @var string|null
     */
    private $eventLoopWatcherId;

    /**
     * @param TelegramUpdateDispatcher $updateDispatcher
     * @param MutexFactory             $mutexFactory
     * @param LoggerInterface          $logger
     */
    public function __construct(
        TelegramUpdateDispatcher $updateDispatcher,
        MutexFactory $mutexFactory,
        LoggerInterface $logger
    ) {
        $this->updateDispatcher = $updateDispatcher;
        $this->mutexFactory     = $mutexFactory;
        $this->logger           = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function run(
        InteractionsProvider $interactionsProvider,
        TelegramCredentials $credentials,
        EntryPointConfig $config
    ): Promise {
        if (false === ($config instanceof LongPoolingConfig))
        {
            throw new \LogicException('Incorrect configuration specified');
        }

        /** @var LongPoolingConfig $config */

        return call(
            function() use ($interactionsProvider, $credentials, $config): \Generator
            {
                $dispatcher   = $this->updateDispatcher;
                $mutexFactory = $this->mutexFactory;
                $logger       = $this->logger;
                $offset       = $config->offset;

                yield from self::disableWebHook($interactionsProvider, $credentials, $logger);

                $this->eventLoopWatcherId = Loop::repeat(
                    $config->interval,
                    static function() use ($dispatcher, $interactionsProvider, $credentials, $logger, $config, $mutexFactory, &$offset): \Generator
                    {
                        /** @var int|null $offset */
                        $mutex = $mutexFactory->create(\sha1(\sprintf('%s:getUpdates', $credentials->token)));

                        /** @var \ServiceBus\Mutex\Lock $lock */
                        $lock = yield $mutex->acquire();

                        try
                        {
                            /** @var \Traversable $updates */
                            $updates = yield from self::receiveUpdates($interactionsProvider, $config, $credentials, $offset);

                            self::processUpdates($updates, $dispatcher, $logger, $offset);
                        }
                        catch (\Throwable $throwable)
                        {
                            $logger->error($throwable->getMessage(), [
                                'throwablePoint' => \sprintf('%s:%d', $throwable->getFile(), $throwable->getLine()),
                            ]);
                        }
                        finally
                        {
                            yield $lock->release();
                        }
                    }
                );
            }
        );
    }

    /**
     * {@inheritdoc}
     */
    public function stop(): Promise
    {
        if (null !== $this->eventLoopWatcherId)
        {
            Loop::cancel($this->eventLoopWatcherId);
        }

        return new Success();
    }

    /**
     * @param InteractionsProvider $interactionsProvider
     * @param LongPoolingConfig    $config
     * @param TelegramCredentials  $credentials
     * @param int|null             $offset
     *
     * @throws \RuntimeException
     *
     * @return \Generator
     *
     */
    private static function receiveUpdates(
        InteractionsProvider $interactionsProvider,
        LongPoolingConfig $config,
        TelegramCredentials $credentials,
        ?int $offset
    ): \Generator {
        /** @var \ServiceBus\TelegramBot\Interaction\Result\Fail|\ServiceBus\TelegramBot\Interaction\Result\Success $result */
        $result = yield $interactionsProvider->call(
            GetUpdates::create($offset, $config->limit),
            $credentials
        );

        if ($result instanceof Fail)
        {
            throw new \RuntimeException($result->errorMessage);
        }

        return $result->type;
    }

    /**
     * @param \Traversable             $updates
     * @param TelegramUpdateDispatcher $dispatcher
     * @param LoggerInterface          $logger
     * @param int|null                 $offset
     *
     * @return void
     */
    private static function processUpdates(
        \Traversable $updates,
        TelegramUpdateDispatcher $dispatcher,
        LoggerInterface $logger,
        ?int &$offset
    ): void {
        /** @var \ServiceBus\TelegramBot\Api\Type\Update $update */
        foreach ($updates as $update)
        {
            $dispatcher->dispatch($update)->onResolve(
                static function(?\Throwable $throwable) use ($logger, $update): void
                {
                    if (null !== $throwable)
                    {
                        $logger->error('Message execution failed: {throwableMessage}', [
                            'throwableMessage' => $throwable->getMessage(),
                            'throwablePoint'   => \sprintf('%s:%d', $throwable->getFile(), $throwable->getLine()),
                            'updateId'         => $update->updateId,
                        ]);
                    }
                }
            );

            $offset = $update->updateId + 1;
        }
    }

    /**
     * @param InteractionsProvider $interactionsProvider
     * @param TelegramCredentials  $credentials
     * @param LoggerInterface      $logger
     *
     * @throws \RuntimeException
     *
     * @return \Generator
     *
     */
    private static function disableWebHook(
        InteractionsProvider $interactionsProvider,
        TelegramCredentials $credentials,
        LoggerInterface $logger
    ): \Generator {
        /** @var \ServiceBus\TelegramBot\Interaction\Result\Result $result */
        $result = yield $interactionsProvider->call(DeleteWebhook::create(), $credentials);

        if ($result instanceof Fail)
        {
            throw new \RuntimeException(
                \sprintf('Cant delete webhook: %s', $result->errorMessage)
            );
        }

        $logger->info('Web hooks are disabled');
    }
}
