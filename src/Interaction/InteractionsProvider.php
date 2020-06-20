<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Interaction;

use function Amp\call;
use Amp\Promise;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use ServiceBus\HttpClient\Artax\ArtaxFormBody;
use ServiceBus\HttpClient\Artax\ArtaxHttpClient;
use ServiceBus\HttpClient\HttpClient;
use ServiceBus\HttpClient\HttpRequest;
use ServiceBus\TelegramBot\Api\Method\File\DownloadFile;
use ServiceBus\TelegramBot\Api\Type\SimpleSuccessResponse;
use ServiceBus\TelegramBot\Serializer\SerializationFailed;
use ServiceBus\TelegramBot\Serializer\SymfonySerializer;
use ServiceBus\TelegramBot\Serializer\TelegramSerializer;
use ServiceBus\TelegramBot\TelegramCredentials;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\ValidatorBuilder;
use function ServiceBus\Common\jsonDecode;

/**
 *
 */
final class InteractionsProvider
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
     * @param HttpClient|null         $httpClient
     * @param TelegramSerializer|null $serializer
     */
    public function __construct(?HttpClient $httpClient = null, ?TelegramSerializer $serializer = null)
    {
        /**
         * @noinspection   PhpDeprecationInspection
         * @psalm-suppress DeprecatedMethod This method is deprecated and will be removed in doctrine/annotations 2.0
         */
        AnnotationRegistry::registerLoader('class_exists');
        AnnotationReader::addGlobalIgnoredName('psalm');

        $this->httpClient = $httpClient ?? new ArtaxHttpClient();
        $this->serializer = $serializer ?? new SymfonySerializer();
        $this->validator  = (new ValidatorBuilder())->enableAnnotationMapping()->getValidator();
    }

    /**
     * Execute API request.
     *
     * @param TelegramMethod      $method
     * @param TelegramCredentials $credentials
     *
     * @return Promise<\ServiceBus\TelegramBot\Interaction\Result\Result>
     */
    public function call(TelegramMethod $method, TelegramCredentials $credentials): Promise
    {
        if ($method instanceof DownloadFile)
        {
            return $this->downloadFile($method, $credentials);
        }

        return $this->callCommand($method, $credentials);
    }

    /**
     * Download file.
     *
     * @psalm-suppress MixedReturnTypeCoercion
     *
     * @param DownloadFile        $method
     * @param TelegramCredentials $credentials
     *
     * @return Promise<\ServiceBus\TelegramBot\Interaction\Result\Result>
     */
    private function downloadFile(DownloadFile $method, TelegramCredentials $credentials): Promise
    {
        $httpClient = $this->httpClient;

        /** @psalm-suppress InvalidArgument */
        return call(
            static function(DownloadFile $downloadCommand) use ($httpClient, $credentials): \Generator
            {
                try
                {
                    $url = self::createFileUrl($credentials, $downloadCommand->filePath);

                    yield $httpClient->download($url, $downloadCommand->toDirectory, $downloadCommand->withName);

                    return Result\Success::create(new SimpleSuccessResponse());
                }
                catch (\Throwable $throwable)
                {
                    return Result\Fail::error($throwable->getMessage());
                }
            },
            $method
        );
    }

    /**
     * Execute command.
     *
     * @psalm-suppress MixedReturnTypeCoercion
     *
     * @param TelegramMethod      $method
     * @param TelegramCredentials $credentials
     *
     * @return Promise<\ServiceBus\TelegramBot\Interaction\Result\Result>
     */
    private function callCommand(TelegramMethod $method, TelegramCredentials $credentials): Promise
    {
        $validator  = $this->validator;
        $httpClient = $this->httpClient;
        $serializer = $this->serializer;

        /** @psalm-suppress InvalidArgument */
        return call(
            static function(TelegramMethod $method) use ($credentials, $httpClient, $validator, $serializer): \Generator
            {
                $violations = $validator->validate($method);

                if (0 !== $violations->count())
                {
                    return Result\Fail::validationFailed($violations);
                }

                $httpRequest = self::createRequest($credentials, $method);

                try
                {
                    /** @var \GuzzleHttp\Psr7\Response $response */
                    $response = yield $httpClient->execute($httpRequest);

                    if (200 === $response->getStatusCode())
                    {
                        return Result\Success::create(
                            self::parseResponse($serializer, (string) $response->getBody(), $method->typeClass())
                        );
                    }

                    if (404 === $response->getStatusCode())
                    {
                        throw new \RuntimeException(\sprintf('Method %s not exists', $method->methodName()));
                    }

                    throw new \RuntimeException(
                        \sprintf('Incorrect server response code: %d', $response->getStatusCode())
                    );
                }
                catch (SerializationFailed $exception)
                {
                    return Result\Fail::error(\sprintf(
                        'Unserialize message failed: %s',
                        $exception->getMessage()
                    ));
                }
                catch (\Throwable $throwable)
                {
                    return Result\Fail::error($throwable->getMessage());
                }
            },
            $method
        );
    }

    /**
     * Create request object.
     *
     * @param TelegramCredentials $credentials
     * @param TelegramMethod      $method
     *
     * @return HttpRequest
     */
    private static function createRequest(TelegramCredentials $credentials, TelegramMethod $method): HttpRequest
    {
        $endpointUrl = self::createCommandUrl($credentials, $method);

        $parameters = $method->requestData();

        /** @psalm-suppress MixedArgumentTypeCoercion */
        return ('GET' === $method->httpRequestMethod())
            ? HttpRequest::get($endpointUrl, $parameters)
            /** @todo: fix form body creating */
            : HttpRequest::post($endpointUrl, ArtaxFormBody::fromParameters($parameters));
    }

    /**
     * @param TelegramSerializer $serializer
     * @param string             $json
     * @param string             $toClass
     *
     * @throws \RuntimeException
     *
     * @return object
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
        $payload = jsonDecode($json);

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
     * Receive command endpoint URL.
     *
     * @param TelegramCredentials $credentials
     * @param TelegramMethod      $method
     *
     * @return string
     */
    private static function createCommandUrl(TelegramCredentials $credentials, TelegramMethod $method): string
    {
        return \str_replace(
            ['{token}', '{action}'],
            [$credentials->token, $method->methodName()],
            self::TELEGRAM_COMMAND_ENDPOINT_URL_PATTERN
        );
    }

    /**
     * Receive file endpoint URL.
     *
     * @param TelegramCredentials $credentials
     * @param string              $filePath
     *
     * @return string
     */
    private static function createFileUrl(TelegramCredentials $credentials, string $filePath): string
    {
        return \str_replace(
            ['{token}', '{filePath}'],
            [$credentials->token, $filePath],
            self::TELEGRAM_FILE_ENDPOINT_URL_PATTERN
        );
    }
}
