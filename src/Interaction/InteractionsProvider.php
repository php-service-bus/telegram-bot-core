<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types=0);

namespace ServiceBus\TelegramBot\Interaction;

use ServiceBus\TelegramBot\Hydrator\TelegramHydrator;
use Amp\Promise;
use ServiceBus\HttpClient\Artax\ArtaxFormBody;
use ServiceBus\HttpClient\Artax\ArtaxHttpClient;
use ServiceBus\HttpClient\HttpClient;
use ServiceBus\HttpClient\HttpRequest;
use ServiceBus\TelegramBot\Api\Method\File\DownloadFile;
use ServiceBus\TelegramBot\Api\Type\SimpleSuccessResponse;
use ServiceBus\TelegramBot\Hydrator\SerializationFailed;
use ServiceBus\TelegramBot\TelegramCredentials;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Validator\ValidatorBuilder;
use function Amp\call;
use function ServiceBus\Common\jsonDecode;

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
     * @var TelegramHydrator
     */
    private $telegramHydrator;

    public function __construct(?HttpClient $httpClient = null, ?TelegramHydrator $telegramHydrator = null)
    {
        $this->httpClient       = $httpClient ?? ArtaxHttpClient::build();
        $this->telegramHydrator = $telegramHydrator ?? TelegramHydrator::default();
        $this->validator        = (new ValidatorBuilder())->enableAnnotationMapping()->getValidator();
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
                    $responseBody = (string) $response->getBody();

                    if ($response->getStatusCode() === 200)
                    {
                        if ($responseBody === '')
                        {
                            throw new \RuntimeException(
                                \sprintf('Unexpected empty response body. Action: %s', get_class($method))
                            );
                        }

                        return Result\Success::create(
                            $this->parseResponse(
                                json: $responseBody,
                                toClass: $method->typeClass()
                            )
                        );
                    }

                    if ($response->getStatusCode() === 400)
                    {
                        /** @psalm-var non-empty-string $responseBody */
                        $responseDetails = jsonDecode($responseBody);

                        throw new \RuntimeException(
                            $responseDetails['description']
                            ?? \sprintf('Method %s has invalid parameters', $method->methodName())
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
            /** @phpstan-ignore-next-line */
            ? HttpRequest::get($endpointUrl, $parameters)
            /** @phpstan-ignore-next-line */
            : HttpRequest::post($endpointUrl, ArtaxFormBody::fromParameters($parameters));
    }

    /**
     * @template T of object
     * @psalm-param non-empty-string $json
     * @psalm-param class-string<T>  $toClass
     * @psalm-return T
     *
     * @throws \RuntimeException
     */
    private function parseResponse(string $json, string $toClass): object
    {
        /** @psalm-var class-string<T> $toClass $payload */

        $payload = jsonDecode($json);

        if (isset($payload['ok']) && true === $payload['ok'])
        {
            /** @psalm-var array|scalar $result */
            $result = $payload['result'] ?? [];

            return $this->telegramHydrator->handle(
                payload: \is_scalar($result)
                    ? ['value' => $result]
                    : $result,
                toClass: $toClass
            );
        }

        throw new \RuntimeException((string) ($payload['description'] ?? 'Incorrect response payload'));
    }

    /**
     * Receive command endpoint URL.
     *
     * @return non-empty-string
     */
    private static function createCommandUrl(TelegramCredentials $credentials, TelegramMethod $method): string
    {
        /**
         * @noinspection PhpUnnecessaryLocalVariableInspection
         *
         * @psalm-var non-empty-string $url
         */
        $url = \str_replace(
            ['{token}', '{action}'],
            [$credentials->token, $method->methodName()],
            self::TELEGRAM_COMMAND_ENDPOINT_URL_PATTERN
        );

        return $url;
    }

    /**
     * Receive file endpoint URL.
     *
     * @return non-empty-string
     */
    private static function createFileUrl(TelegramCredentials $credentials, string $filePath): string
    {
        /**
         * @noinspection PhpUnnecessaryLocalVariableInspection
         *
         * @psalm-var non-empty-string $url
         */
        $url = \str_replace(
            ['{token}', '{filePath}'],
            [$credentials->token, $filePath],
            self::TELEGRAM_FILE_ENDPOINT_URL_PATTERN
        );

        return $url;
    }
}
