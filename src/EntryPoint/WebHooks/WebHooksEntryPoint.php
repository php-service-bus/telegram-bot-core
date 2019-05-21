<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\EntryPoint\WebHooks;

use function Amp\call;
use function ServiceBus\TelegramBot\Event\adapt;
use function ServiceBus\TelegramBot\Serializer\jsonDecode;
use Amp\Cluster\Cluster;
use Amp\Http\Server\Request;
use Amp\Http\Server\RequestHandler\CallableRequestHandler;
use Amp\Http\Server\Response;
use Amp\Http\Server\Server;
use Amp\Http\Status;
use Amp\Promise;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use ServiceBus\TelegramBot\Api\Method\WebHook\SetWebhook;
use ServiceBus\TelegramBot\Api\Result\Fail;
use ServiceBus\TelegramBot\Api\TelegramBotApi;
use ServiceBus\TelegramBot\Api\Type\Update;
use ServiceBus\TelegramBot\Bot\TelegramBot;
use ServiceBus\TelegramBot\Serializer\SymfonySerializer;
use ServiceBus\TelegramBot\Serializer\TelegramSerializer;

/**
 *
 */
final class WebHooksEntryPoint
{
    /**
     * Telegram bot api client.
     *
     * @var TelegramBotApi
     */
    private $apiClient;

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
     * @param TelegramBotApi          $apiClient
     * @param TelegramSerializer|null $serializer
     * @param LoggerInterface|null    $logger
     */
    public function __construct(TelegramBotApi $apiClient, ?TelegramSerializer $serializer = null, ?LoggerInterface $logger = null)
    {
        $this->apiClient  = $apiClient;
        $this->logger     = $logger ?? new NullLogger();
        $this->serializer = $serializer ?? new SymfonySerializer();

        Cluster::onTerminate(
            function(): \Generator
            {
                yield $this->stop();
            }
        );
    }

    /**
     * Run web server.
     *
     * @psalm-param callable(\ServiceBus\TelegramBot\Event\TelegramEvent):\Amp\Promise $onEvent
     *
     * @param callable       $onEvent
     * @param TelegramBot    $bot
     * @param WebHooksConfig $config
     *
     * @return Promise
     */
    public function run(
        callable $onEvent,
        TelegramBot $bot,
        WebHooksConfig $config
    ): Promise
    {
        $requestHandler = $this->createRequestHandler($bot, $onEvent);

        /** @psalm-suppress InvalidArgument */
        return call(
            function(TelegramBot $bot) use ($config, $requestHandler): \Generator
            {
                /** @var Server $server */
                $server = yield from self::createServer($config, $requestHandler, $this->logger);

                $this->server = $server;

                if(false === Cluster::isWorker())
                {
                    yield from self::enableWebHook($bot, $config, $this->apiClient, $this->logger);
                }

                yield $this->server->start();
            },
            $bot
        );
    }

    /**
     * Stop web server.
     *
     * @return Promise
     */
    public function stop(): Promise
    {
        return call(
            function(): \Generator
            {
                if(null !== $this->server)
                {
                    yield $this->server->stop();
                }
            }
        );
    }

    /**
     * @param TelegramBot     $bot
     * @param WebHooksConfig  $config
     * @param TelegramBotApi  $apiClient
     * @param LoggerInterface $logger
     *
     * @return \Generator
     */
    private static function enableWebHook(
        TelegramBot $bot,
        WebHooksConfig $config,
        TelegramBotApi $apiClient,
        LoggerInterface $logger
    ): \Generator
    {
        $callbackUrl = \str_replace(
            '{token}',
            $bot->credentials->token,
            $config->callbackUrl
        );

        /** @var \ServiceBus\TelegramBot\Api\Result\Result $result */
        $result = yield $apiClient->call(SetWebhook::create($callbackUrl, $config->certificateFilePath), $bot);

        if($result instanceof Fail)
        {
            throw new \RuntimeException(
                \sprintf('Cant set webhook details: %s', $result->errorMessage)
            );
        }

        $logger->info('Web hooks are enabled');
    }

    /**
     * @psalm-param  callable(\ServiceBus\TelegramBot\Event\TelegramEvent):\Amp\Promise $messageProcessor
     * @psalm-return callable(Request):\Generator
     *
     * @param TelegramBot $bot
     * @param callable    $messageProcessor
     *
     * @return callable
     */
    private function createRequestHandler(TelegramBot $bot, callable $messageProcessor): callable
    {
        $logger     = $this->logger;
        $serializer = $this->serializer;

        return static function(Request $request) use ($bot, $serializer, $messageProcessor, $logger): \Generator
        {
            if('POST' !== $request->getMethod())
            {
                return new Response(Status::METHOD_NOT_ALLOWED);
            }

            try
            {
                /** @var string $jsonBody */
                $jsonBody = yield $request->getBody()->read();

                $payload = jsonDecode($jsonBody, true);

                /** @var Update $update */
                $update = $serializer->decode($payload, Update::class);

                yield $messageProcessor(
                    adapt($bot, $update)
                );

                return new Response(Status::OK);
            }
            catch(\Throwable $throwable)
            {
                $logger->error('Web hook processing error: {throwableMessage}', [
                    'throwableMessage' => $throwable->getMessage(),
                    'throwablePoint'   => \sprintf('%s:%d', $throwable->getFile(), $throwable->getLine()),
                    'bot'              => $bot->username,
                ]);

                return new Response(Status::INTERNAL_SERVER_ERROR);
            }
        };
    }

    /**
     * Create server instance.
     *
     * @psalm-param callable(Request):\Generator $onRequest
     *
     * @param WebHooksConfig  $config
     * @param callable        $onRequest
     * @param LoggerInterface $logger
     *
     * @return \Generator
     */
    private static function createServer(WebHooksConfig $config, callable $onRequest, LoggerInterface $logger): \Generator
    {
        $listenUri = \sprintf('%s:%d', $config->listenHost, $config->listenPort);

        /** @var \Amp\Socket\Server[] $sockets */
        $sockets = yield [Cluster::listen($listenUri)];

        return new Server($sockets, new CallableRequestHandler($onRequest), $logger);
    }
}
