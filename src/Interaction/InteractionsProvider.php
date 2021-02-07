<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 0);

namespace ServiceBus\TelegramBot\Interaction;

use function Amp\call;
use function ServiceBus\Common\jsonDecode;
use Amp\Promise;
use ServiceBus\HttpClient\Artax\ArtaxFormBody;
use ServiceBus\HttpClient\Artax\ArtaxHttpClient;
use ServiceBus\HttpClient\HttpClient;
use ServiceBus\HttpClient\HttpRequest;
use ServiceBus\TelegramBot\Api\Method\File\DownloadFile;
use ServiceBus\TelegramBot\Api\Type\SimpleSuccessResponse;
use ServiceBus\TelegramBot\Serializer\SerializationFailed;
use ServiceBus\TelegramBot\Serializer\WrappedSymfonySerializer;
use ServiceBus\TelegramBot\Serializer\TelegramSerializer;
use ServiceBus\TelegramBot\TelegramCredentials;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\ValidatorBuilder;

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

    public function __construct(?HttpClient $httpClient = null, ?TelegramSerializer $serializer = null)
    {
        $this->httpClient = $httpClient ?? ArtaxHttpClient::build();
        $this->serializer = $serializer ?? new WrappedSymfonySerializer();
        $this->validator  = (new ValidatorBuilder())->enableAnnotationMapping()->getValidator();
    }

    /**
     * Execute API request.
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
     * @param DownloadFile        $method
     * @param TelegramCredentials $credentials
     *
     * @return Promise<\ServiceBus\TelegramBot\Interaction\Result\Result>
     */
    private function downloadFile(DownloadFile $method, TelegramCredentials $credentials): Promise
    {
        return call(
            function () use ($method, $credentials): \Generator
            {
                try
                {
                    $url = self::createFileUrl($credentials, $method->filePath);

                    yield $this->httpClient->download($url, $method->toDirectory, $method->withName);

                    return Result\Success::create(new SimpleSuccessResponse());
                }
                catch (\Throwable $throwable)
                {
                    return Result\Fail::error($throwable->getMessage());
                }
            }
        );
    }

    /**
     * Execute command.
     *
     * @return Promise<\ServiceBus\TelegramBot\Interaction\Result\Result>
     */
    private function callCommand(TelegramMethod $method, TelegramCredentials $credentials): Promise
    {
        return call(
            function () use ($method, $credentials): \Generator
            {
                $violations = $this->validator->validate($method);

                if ($violations->count() !== 0)
                {
                    return Result\Fail::validationFailed($violations);
                }

                $httpRequest = self::createRequest($credentials, $method);

                try
                {
                    /** @var \GuzzleHttp\Psr7\Response $response */
                    $response = yield $this->httpClient->execute($httpRequest);

                    if ($response->getStatusCode() === 200)
                    {
                        return Result\Success::create(
                            self::parseResponse($this->serializer, (string) $response->getBody(), $method->typeClass())
                        );
                    }

                    if ($response->getStatusCode() === 404)
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
            }
        );
    }

    /**
     * Create request object.
     */
    private static function createRequest(TelegramCredentials $credentials, TelegramMethod $method): HttpRequest
    {
        $endpointUrl = self::createCommandUrl($credentials, $method);

        $parameters = $method->requestData();

        /** @psalm-suppress MixedArgumentTypeCoercion */
        return ($method->httpRequestMethod() === 'GET')
            ? HttpRequest::get($endpointUrl, $parameters)
            /** @todo: fix form body creating */
            : HttpRequest::post($endpointUrl, ArtaxFormBody::fromParameters($parameters));
    }

    /**
     * @psalm-suppress InvalidReturnType
     * @template T
     * @psalm-param class-string<T> $toClass
     * @psalm-return T
     *
     * @throws \RuntimeException
     */
    private static function parseResponse(TelegramSerializer $serializer, string $json, string $toClass): object
    {
        if ($toClass === SimpleSuccessResponse::class)
        {
            /** @psalm-suppress InvalidReturnStatement */
            return new SimpleSuccessResponse();
        }

        /**
         * @psalm-var array{ok: bool, result: scalar|array}
         */
        $payload = jsonDecode($json);

        if (isset($payload['ok']) && true === $payload['ok'])
        {
            return $serializer->decode(
                \is_scalar($payload['result'])
                    ? ['value' => $payload['result']]
                    : $payload['result'],
                $toClass
            );
        }

        throw new \RuntimeException((string) ($payload['description'] ?? 'Incorrect response payload'));
    }

    /**
     * Receive command endpoint URL.
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
