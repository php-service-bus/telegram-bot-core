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
use Amp\Cluster\Cluster;
use Amp\Http\Server\Request;
use Amp\Http\Server\RequestHandler\CallableRequestHandler;
use Amp\Http\Server\Response;
use Amp\Http\Server\Server;
use Amp\Http\Status;
use Amp\Loop;
use Amp\Promise;
use Psr\Log\LoggerInterface;
use ServiceBus\TelegramBot\Api\Method\WebHook\SetWebhook;
use ServiceBus\TelegramBot\Api\Type\Update;
use ServiceBus\TelegramBot\EntryPoint\Configuration\EntryPointConfig;
use ServiceBus\TelegramBot\EntryPoint\Configuration\WebHooksConfig;
use ServiceBus\TelegramBot\EntryPoint\TelegramUpdateDispatcher;
use ServiceBus\TelegramBot\Interaction\InteractionsProvider;
use ServiceBus\TelegramBot\Interaction\Result\Fail;
use ServiceBus\TelegramBot\Serializer\TelegramSerializer;
use ServiceBus\TelegramBot\TelegramCredentials;
use function ServiceBus\Common\jsonDecode;

/**
 * @internal
 */
final class WebServerUpdater implements Updater
{
    /**
     * @var TelegramUpdateDispatcher
     */
    private $updateDispatcher;

    /**
     * @var TelegramSerializer
     */
    private $serializer;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var Server|null
     */
    private $server;

    /**
     * @param TelegramUpdateDispatcher $updateDispatcher
     * @param TelegramSerializer       $serializer
     * @param LoggerInterface          $logger
     */
    public function __construct(
        TelegramUpdateDispatcher $updateDispatcher,
        TelegramSerializer $serializer,
        LoggerInterface $logger
    )
    {
        $this->updateDispatcher = $updateDispatcher;
        $this->serializer       = $serializer;
        $this->logger           = $logger;

        Cluster::onTerminate(
            function(): \Generator
            {
                yield $this->stop();
            }
        );
    }

    /**
     * {@inheritdoc}
     */
    public function run(
        InteractionsProvider $interactionsProvider,
        TelegramCredentials $credentials,
        EntryPointConfig $config
    ): Promise
    {
        if(false === ($config instanceof WebHooksConfig))
        {
            throw new \LogicException('Incorrect configuration specified');
        }

        /** @var WebHooksConfig $config */
        $requestHandler = self::createHttpRequestHandler($this->updateDispatcher, $this->serializer, $this->logger);

        return call(
            function() use ($interactionsProvider, $credentials, $config, $requestHandler): \Generator
            {
                yield from self::enableWebHook($interactionsProvider, $credentials, $config, $this->logger);

                /** @var Server $server */
                $server = yield from self::createHttpServer($config, $this->logger, $requestHandler);

                $this->server = $server;

                yield $this->server->start();
            }
        );
    }

    /**
     * {@inheritdoc}
     */
    public function stop(): Promise
    {
        return call(
            function(): \Generator
            {
                if(null !== $this->server)
                {
                    yield $this->server->stop();

                    if(true === Cluster::isWorker())
                    {
                        Loop::stop();
                    }
                }
            }
        );
    }

    /**
     * @param WebHooksConfig  $config
     * @param LoggerInterface $logger
     * @param callable        $onRequest
     *
     * @throws \Throwable
     *
     * @return \Generator
     *
     */
    private static function createHttpServer(WebHooksConfig $config, LoggerInterface $logger, callable $onRequest): \Generator
    {
        $listenUri = \sprintf('%s:%d', $config->listenHost, $config->listenPort);

        /** @var \Amp\Socket\Server[] $sockets */
        $sockets = yield [Cluster::listen($listenUri)];

        return new Server($sockets, new CallableRequestHandler($onRequest), $logger);
    }

    /**
     * @psalm-return callable(Request):\Generator
     *
     * @param TelegramUpdateDispatcher $dispatcher
     * @param TelegramSerializer       $serializer
     * @param LoggerInterface          $logger
     *
     * @return callable
     */
    private static function createHttpRequestHandler(
        TelegramUpdateDispatcher $dispatcher,
        TelegramSerializer $serializer,
        LoggerInterface $logger
    ): callable
    {
        return static function(Request $request) use ($serializer, $dispatcher, $logger): \Generator
        {
            if('POST' !== $request->getMethod())
            {
                return new Response(Status::METHOD_NOT_ALLOWED);
            }

            try
            {
                /** @var string $jsonBody */
                $jsonBody = yield $request->getBody()->read();

                $logger->debug(
                    'Notification request: {notificationPayload}',
                    ['notificationPayload' => $jsonBody]
                );

                $payload = jsonDecode($jsonBody);

                /** @var Update $update */
                $update = $serializer->decode($payload, Update::class);

                if(true === empty($update->updateId))
                {
                    return new Response(Status::BAD_REQUEST);
                }

                yield $dispatcher->dispatch($update);

                return new Response(Status::OK);
            }
            catch(\Throwable $throwable)
            {
                $logger->error('Web hook processing error: {throwableMessage}', [
                    'throwableMessage' => $throwable->getMessage(),
                    'throwablePoint'   => \sprintf('%s:%d', $throwable->getFile(), $throwable->getLine()),
                ]);

                return new Response(Status::INTERNAL_SERVER_ERROR);
            }
        };
    }

    /**
     * @param InteractionsProvider $interactionsProvider
     * @param TelegramCredentials  $credentials
     * @param WebHooksConfig       $webHooksConfig
     * @param LoggerInterface      $logger
     *
     * @throws \RuntimeException
     *
     * @return \Generator
     *
     */
    private static function enableWebHook(
        InteractionsProvider $interactionsProvider,
        TelegramCredentials $credentials,
        WebHooksConfig $webHooksConfig,
        LoggerInterface $logger
    ): \Generator
    {
        /** @var \ServiceBus\TelegramBot\Interaction\Result\Result $result */
        $result = yield $interactionsProvider->call(
            SetWebhook::create($webHooksConfig->callbackUrl, $webHooksConfig->certificateFilePath),
            $credentials
        );

        if($result instanceof Fail)
        {
            throw new \RuntimeException(
                \sprintf('Cant set webhook details: %s', $result->errorMessage)
            );
        }

        $logger->info('Web hooks are enabled');
    }
}
