<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\EntryPoint\LongPooling;

use function Amp\call;
use function ServiceBus\TelegramBot\Event\adapt;
use Amp\Loop;
use Amp\Promise;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use ServiceBus\Mutex\InMemoryMutexFactory;
use ServiceBus\Mutex\MutexFactory;
use ServiceBus\TelegramBot\Api\Method\GetUpdates;
use ServiceBus\TelegramBot\Api\Method\WebHook\DeleteWebhook;
use ServiceBus\TelegramBot\Api\Result\Fail;
use ServiceBus\TelegramBot\Api\Result\Success;
use ServiceBus\TelegramBot\Api\TelegramBotApi;
use ServiceBus\TelegramBot\Api\Type\Message\MessageId;
use ServiceBus\TelegramBot\Api\Type\UpdateCollection;
use ServiceBus\TelegramBot\Bot\TelegramBot;

/**
 * Call getUpdates method for receiving new updates.
 */
final class LongPollingEntryPoint
{
    /**
     * Telegram bot api client.
     *
     * @var TelegramBotApi
     */
    private $apiClient;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var MutexFactory
     */
    private $mutexFactory;

    /**
     * Watcher id.
     *
     * @var string|null
     */
    private $eventLoopWatcherId;

    /**
     * @param TelegramBotApi       $apiClient
     * @param LoggerInterface|null $logger
     * @param MutexFactory|null    $mutexFactory
     */
    public function __construct(
        TelegramBotApi $apiClient,
        ?LoggerInterface $logger = null,
        MutexFactory $mutexFactory = null
    )
    {
        $this->apiClient    = $apiClient;
        $this->logger       = $logger ?? new NullLogger();
        $this->mutexFactory = $mutexFactory ?? new InMemoryMutexFactory();
    }

    /**
     * @psalm-param callable(\ServiceBus\TelegramBot\Event\TelegramEvent):\Amp\Promise $onEvent
     *
     * @param callable               $onEvent
     * @param TelegramBot            $bot
     * @param LongPoolingConfig|null $longPoolingConfig
     * @param MessageId|null         $fromMessage
     *
     * @return Promise
     */
    public function run(
        callable $onEvent,
        TelegramBot $bot,
        ?LongPoolingConfig $longPoolingConfig = null,
        ?MessageId $fromMessage = null
    ): Promise
    {
        /** @psalm-suppress InvalidArgument */
        return call(
            function(TelegramBot $bot, LongPoolingConfig $longPoolingConfig) use ($onEvent, $fromMessage): \Generator
            {
                $longPoolingConfig = $longPoolingConfig ?? LongPoolingConfig::createDefault();

                /** Disable web hooks support */
                yield $this->apiClient->call(DeleteWebhook::create(), $bot);

                $this->logger->info('Web hooks are disabled', ['bot' => $bot->username]);

                $this->eventLoopWatcherId = self::start(
                    $bot,
                    $longPoolingConfig,
                    $onEvent,
                    $this->apiClient,
                    $this->mutexFactory,
                    $this->logger,
                    $fromMessage
                );
            },
            $bot,
            $longPoolingConfig ?? LongPoolingConfig::createDefault()
        );
    }

    /**
     * @psalm-param callable(\ServiceBus\TelegramBot\Event\TelegramEvent):\Amp\Promise $onEvent
     *
     * @param TelegramBot       $bot
     * @param LongPoolingConfig $longPoolingConfig
     * @param callable          $onEvent
     * @param TelegramBotApi    $apiClient
     * @param MutexFactory      $mutexFactory
     * @param LoggerInterface   $logger
     * @param MessageId|null    $fromMessage
     *
     * @return string
     */
    private static function start(
        TelegramBot $bot,
        LongPoolingConfig $longPoolingConfig,
        callable $onEvent,
        TelegramBotApi $apiClient,
        MutexFactory $mutexFactory,
        LoggerInterface $logger,
        ?MessageId $fromMessage
    ): string
    {
        $offset = null !== $fromMessage ? (int) $fromMessage->toString() : null;
        $limit  = $longPoolingConfig->limit;

        return Loop::repeat(
            $longPoolingConfig->interval,
            static function() use ($bot, $apiClient, $mutexFactory, $onEvent, $logger, &$offset, $limit): \Generator
            {
                try
                {
                    $mutex = $mutexFactory->create(\sprintf('%s:getUpdates', $bot->username));

                    /**
                     * @psalm-suppress TooManyTemplateParams
                     *
                     * @var \ServiceBus\Mutex\Lock $lock
                     */
                    $lock = yield $mutex->acquire();

                    /**
                     * @var int|null     $offset
                     * @var Fail|Success $result
                     */
                    $result = yield $apiClient->call(GetUpdates::create($offset, $limit), $bot);

                    if($result instanceof Fail)
                    {
                        $logger->error($result->errorMessage);

                        /** @psalm-suppress TooManyTemplateParams */
                        yield $lock->release();

                        return;
                    }

                    /** @var UpdateCollection $updates */
                    $updates = $result->type;

                    self::processUpdates($bot, $updates, $onEvent, $logger, $offset);

                    yield $lock->release();
                }
                catch(\Throwable $throwable)
                {
                    $logger->error($throwable->getMessage(), [
                        'throwablePoint' => \sprintf('%s:%d', $throwable->getFile(), $throwable->getLine()),
                        'bot'            => $bot->username,
                    ]);
                }
                finally
                {
                    unset($mutex, $lock, $updates, $result);
                }
            }
        );
    }

    /**
     * @psalm-param callable(\ServiceBus\TelegramBot\Event\TelegramEvent):\Amp\Promise $onEvent
     *
     * @param TelegramBot      $bot
     * @param UpdateCollection $updateCollection
     * @param callable         $onEvent
     * @param LoggerInterface  $logger
     * @param int|null         $offset
     *
     * @return void
     */
    private static function processUpdates(
        TelegramBot $bot,
        UpdateCollection $updateCollection,
        callable $onEvent,
        LoggerInterface $logger,
        ?int &$offset
    ): void
    {
        /** @var \ServiceBus\TelegramBot\Api\Type\Update $update */
        foreach($updateCollection as $update)
        {
            $event = adapt(clone $bot, $update);

            $logger->info(
                'Received "{eventType}" message',
                [
                    'eventType' => \get_class($event),
                    'bot'       => $bot->username,
                ]
            );

            $onEvent(adapt($bot, $update))
                ->onResolve(
                    static function(?\Throwable $throwable) use ($update, $logger, $bot): void
                    {
                        if(null !== $throwable)
                        {
                            $logger->error('Message execution failed: {throwableMessage}', [
                                'throwableMessage' => $throwable->getMessage(),
                                'throwablePoint'   => \sprintf('%s:%d', $throwable->getFile(), $throwable->getLine()),
                                'bot'              => $bot->username,
                                'updateId'         => $update->updateId,
                            ]);
                        }
                    }
                );

            $offset = $update->updateId + 1;
        }
    }
}
