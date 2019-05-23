<?php

/**
 * Telegram TelegramBot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\EntryPoint;

use function Amp\call;
use Amp\Promise;
use Amp\Success;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use ServiceBus\HttpClient\Artax\ArtaxHttpClient;
use ServiceBus\HttpClient\HttpClient;
use ServiceBus\Mutex\InMemoryMutexFactory;
use ServiceBus\Mutex\MutexFactory;
use ServiceBus\TelegramBot\EntryPoint\Configuration\EntryPointConfig;
use ServiceBus\TelegramBot\EntryPoint\Configuration\LongPoolingConfig;
use ServiceBus\TelegramBot\EntryPoint\Configuration\WebHooksConfig;
use ServiceBus\TelegramBot\Interaction\InteractionsProvider;
use ServiceBus\TelegramBot\Serializer\SymfonySerializer;
use ServiceBus\TelegramBot\Serializer\TelegramSerializer;
use ServiceBus\TelegramBot\TelegramCredentials;

/**
 *
 */
final class EntryPoint
{
    /**
     * @var TelegramUpdateDispatcher
     */
    private $dispatcher;

    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var TelegramSerializer
     */
    private $serializer;

    /**
     * @var MutexFactory
     */
    private $mutexFactory;

    /**
     * @var Updater\Updater|null
     */
    private $updater;

    /**
     * @param TelegramUpdateDispatcher $dispatcher
     * @param LoggerInterface|null     $logger
     * @param HttpClient|null          $httpClient
     * @param TelegramSerializer|null  $serializer
     * @param MutexFactory|null        $mutexFactory
     */
    public function __construct(
        TelegramUpdateDispatcher $dispatcher,
        ?LoggerInterface $logger = null,
        ?HttpClient $httpClient = null,
        ?TelegramSerializer $serializer = null,
        MutexFactory $mutexFactory = null
    ) {
        $this->dispatcher   = $dispatcher;
        $this->logger       = $logger ?? new NullLogger();
        $this->httpClient   = $httpClient ?? new ArtaxHttpClient(null, null, $this->logger);
        $this->serializer   = $serializer ?? new SymfonySerializer();
        $this->mutexFactory = $mutexFactory ?? new InMemoryMutexFactory();
    }

    /**
     * @param TelegramCredentials $credentials
     * @param EntryPointConfig    $config
     *
     * @return Promise
     */
    public function run(TelegramCredentials $credentials, EntryPointConfig $config): Promise
    {
        $interactionsProvider = new InteractionsProvider($this->httpClient);

        return call(
            function() use ($interactionsProvider, $credentials, $config): \Generator
            {
                try
                {
                    $this->updater = $this->createUpdater($config);

                    yield $this->updater->run($interactionsProvider, $credentials, $config);
                }
                catch (\Throwable $throwable)
                {
                    $this->logger->error($throwable->getMessage(), [
                        'throwablePoint' => \sprintf('%s:%d', $throwable->getFile(), $throwable->getLine()),
                    ]);
                }
            }
        );
    }

    /**
     * @return Promise
     */
    public function cancel(): Promise
    {
        if (null !== $this->updater)
        {
            return $this->updater->stop();
        }

        return new Success();
    }

    /**
     * @param EntryPointConfig $config
     *
     * @return Updater\Updater
     */
    private function createUpdater(EntryPointConfig $config): Updater\Updater
    {
        if ($config instanceof WebHooksConfig)
        {
            return new Updater\WebServerUpdater($this->dispatcher, $this->serializer, $this->logger);
        }

        if ($config instanceof LongPoolingConfig)
        {
            return new Updater\LongPoolingUpdater($this->dispatcher, $this->mutexFactory, $this->logger);
        }

        throw new \LogicException('Unsupported config specified');
    }
}
