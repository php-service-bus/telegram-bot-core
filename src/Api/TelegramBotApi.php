<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api;

use function Amp\call;
use function ServiceBus\TelegramBot\Serializer\jsonDecode;
use Amp\Promise;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use ServiceBus\HttpClient\Artax\ArtaxFormBody;
use ServiceBus\HttpClient\Artax\ArtaxHttpClient;
use ServiceBus\HttpClient\HttpClient;
use ServiceBus\HttpClient\HttpRequest;
use ServiceBus\TelegramBot\Api\Method\BotCommand;
use ServiceBus\TelegramBot\Api\Method\File\DownloadFile;
use ServiceBus\TelegramBot\Api\Result\Fail;
use ServiceBus\TelegramBot\Api\Result\Success;
use ServiceBus\TelegramBot\Api\Type\SimpleSuccessResponse;
use ServiceBus\TelegramBot\Bot\TelegramBot;
use ServiceBus\TelegramBot\Serializer\SerializationFailed;
use ServiceBus\TelegramBot\Serializer\SymfonySerializer;
use ServiceBus\TelegramBot\Serializer\TelegramSerializer;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\ValidatorBuilder;

/**
 * Telegram bot api client.
 */
final class TelegramBotApi
{
    private const TELEGRAM_COMMAND_ENDPOINT_URL_PATTERN = 'https://api.telegram.org/bot{token}/{action}';

    private const TELEGRAM_FILE_ENDPOINT_URL_PATTERN = 'https://api.telegram.org/file/bot{token}/{filePath}';

    /**
     * @var HttpClient
     */
    private $httpClient;

    /**
     * @var ValidatorInterface
     */
    private $validator;

    /**
     * @var TelegramSerializer
     */
    private $serializer;

    /**
     * @param HttpClient              $httpClient
     * @param ValidatorInterface      $validator
     * @param TelegramSerializer|null $serializer
     */
    public function __construct(
        ?HttpClient $httpClient = null,
        ?ValidatorInterface $validator = null,
        ?TelegramSerializer $serializer = null
    ) {
        /**
         * @noinspection   PhpDeprecationInspection
         * @psalm-suppress DeprecatedMethod This method is deprecated and will be removed in doctrine/annotations 2.0
         */
        AnnotationRegistry::registerLoader('class_exists');
        AnnotationReader::addGlobalIgnoredName('psalm');

        if (null === $validator)
        {
            $validator = (new ValidatorBuilder())->enableAnnotationMapping()->getValidator();
        }

        $this->httpClient = $httpClient ?? new ArtaxHttpClient();
        $this->validator  = $validator;
        $this->serializer = $serializer ?? new SymfonySerializer();
    }

    /**
     * Execute API request.
     *
     * @param BotCommand  $command
     * @param TelegramBot $bot
     *
     * @return Promise<\ServiceBus\TelegramBot\Api\Result\Result>
     */
    public function call(BotCommand $command, TelegramBot $bot): Promise
    {
        if ($command instanceof DownloadFile)
        {
            return $this->downloadFile($bot, $command);
        }

        return $this->callCommand($bot, $command);
    }

    /**
     * Download file.
     *
     * @psalm-suppress MixedReturnTypeCoercion
     *
     * @param TelegramBot  $bot
     * @param DownloadFile $downloadCommand
     *
     * @return Promise<\ServiceBus\TelegramBot\Api\Result\Result>
     */
    private function downloadFile(TelegramBot $bot, DownloadFile $downloadCommand): Promise
    {
        $httpClient = $this->httpClient;

        /** @psalm-suppress InvalidArgument */
        return call(
            static function(DownloadFile $downloadCommand) use ($httpClient, $bot): \Generator
            {
                try
                {
                    $url = self::createFileUrl($bot, $downloadCommand->filePath);

                    /** @psalm-suppress TooManyTemplateParams */
                    yield $httpClient->download($url, $downloadCommand->toDirectory, $downloadCommand->withName);

                    return Success::create(new SimpleSuccessResponse());
                }
                catch (\Throwable $throwable)
                {
                    throw new \RuntimeException(
                        \sprintf('Incorrect server response %s', $throwable->getMessage())
                    );
                }
            },
            $downloadCommand
        );
    }

    /**
     * Execute command.
     *
     * @psalm-suppress MixedReturnTypeCoercion
     *
     * @param TelegramBot $bot
     * @param BotCommand  $command
     *
     * @return Promise<\ServiceBus\TelegramBot\Api\Result\Result>
     */
    private function callCommand(TelegramBot $bot, BotCommand $command): Promise
    {
        $validator  = $this->validator;
        $httpClient = $this->httpClient;
        $serializer = $this->serializer;

        /** @psalm-suppress InvalidArgument */
        return call(
            static function(BotCommand $command) use ($bot, $httpClient, $validator, $serializer): \Generator
            {
                $violations = $validator->validate($command);

                if (0 !== $violations->count())
                {
                    return Fail::validationFailed($violations);
                }

                $httpRequest = self::createRequest($bot, $command);

                try
                {
                    /**
                     * @psalm-suppress TooManyTemplateParams
                     *
                     * @var \GuzzleHttp\Psr7\Response $response
                     */
                    $response = yield $httpClient->execute($httpRequest);

                    if (200 === $response->getStatusCode())
                    {
                        return Success::create(
                            self::parseResponse($serializer, (string) $response->getBody(), $command->typeClass())
                        );
                    }

                    if (404 === $response->getStatusCode())
                    {
                        throw new \RuntimeException(\sprintf('Method %s not exists', $command->methodName()));
                    }

                    throw new \RuntimeException(
                        \sprintf('Incorrect server response code: %d', $response->getStatusCode())
                    );
                }
                catch (SerializationFailed $exception)
                {
                    return Fail::error(\sprintf(
                        'Unserialize message failed: %s',
                        $exception->getMessage()
                    ));
                }
                catch (\Throwable $throwable)
                {
                    return Fail::error($throwable->getMessage());
                }
            },
            $command
        );
    }

    /**
     * @param TelegramSerializer $serializer
     * @param string             $json
     * @param string             $toClass
     *
     * @throws \RuntimeException
     *
     * @return object
     *
     */
    private static function parseResponse(TelegramSerializer $serializer, string $json, string $toClass): object
    {
        if (SimpleSuccessResponse::class === $toClass)
        {
            return new SimpleSuccessResponse();
        }

        /**
         * @psalm-var array{ok: bool, result: scalar|array}
         */
        $payload = jsonDecode($json, true);

        if (true === isset($payload['ok']) && true === $payload['ok'])
        {
            return $serializer->decode(
                true === \is_scalar($payload['result'])
                    ? ['value' => $payload['result']]
                    : $payload['result'],
                $toClass
            );
        }

        throw new \RuntimeException((string) ($payload['description'] ?? 'Incorrect response payload'));
    }

    /**
     * Create request object.
     *
     * @param TelegramBot $bot
     * @param BotCommand  $method
     *
     * @return HttpRequest
     */
    private static function createRequest(TelegramBot $bot, BotCommand $method): HttpRequest
    {
        $endpointUrl = self::createCommandUrl($bot, $method);

        $parameters = $method->requestData();

        /** @psalm-suppress MixedArgumentTypeCoercion */
        return ('GET' === $method->httpRequestMethod())
            ? HttpRequest::get($endpointUrl, $parameters)
            : HttpRequest::post($endpointUrl, ArtaxFormBody::fromParameters($parameters));
    }

    /**
     * Receive command endpoint URL.
     *
     * @param TelegramBot $bot
     * @param BotCommand  $method
     *
     * @return string
     */
    private static function createCommandUrl(TelegramBot $bot, BotCommand $method): string
    {
        return \str_replace(
            ['{token}', '{action}'],
            [$bot->credentials->token, $method->methodName()],
            self::TELEGRAM_COMMAND_ENDPOINT_URL_PATTERN
        );
    }

    /**
     * Receive file endpoint URL.
     *
     * @param TelegramBot $bot
     * @param string      $filePath
     *
     * @return string
     */
    private function createFileUrl(TelegramBot $bot, string $filePath): string
    {
        return \str_replace(
            ['{token}', '{filePath}'],
            [$bot->credentials->token, $filePath],
            self::TELEGRAM_FILE_ENDPOINT_URL_PATTERN
        );
    }
}
