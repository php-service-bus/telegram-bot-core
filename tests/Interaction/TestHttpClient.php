<?php /** @noinspection PhpUnhandledExceptionInspection */

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Tests\Interaction;

use Amp\Failure;
use Amp\Promise;
use Amp\Success;
use GuzzleHttp\Psr7\Response as Psr7Response;
use ServiceBus\HttpClient\Exception\HttpClientException;
use ServiceBus\HttpClient\HttpClient;
use ServiceBus\HttpClient\HttpRequest;
use ServiceBus\HttpClient\RequestContext;

/**
 *
 */
final class TestHttpClient implements HttpClient
{
    /**
     * @var string|null
     */
    private $expectedPayload;

    /**
     * @var int|null
     */
    private $expectedStatusCode;

    /**
     * @var string|null
     */
    private $expectedFailMessage;

    public static function create(string $payload, int $statusCode): self
    {
        $self = new self();

        $self->expectedPayload    = $payload;
        $self->expectedStatusCode = $statusCode;

        return $self;
    }

    public static function failed(string $message): self
    {
        $self = new self();

        $self->expectedFailMessage = $message;

        return $self;
    }

    public function execute(HttpRequest $requestData, ?RequestContext $context = null): Promise
    {
        return $this->expectedFailMessage === null
            ? new Success(new Psr7Response($this->expectedStatusCode, [], $this->expectedPayload))
            : new Failure(new HttpClientException($this->expectedFailMessage));

    }

    public function download(
        string $fileUrl,
        string $destinationDirectory,
        string $fileName,
        ?RequestContext $context = null
    ): Promise
    {
        return $this->expectedFailMessage === null
            ? new Success(__FILE__)
            : new Failure(new HttpClientException($this->expectedFailMessage));
    }

    private function __construct()
    {
    }
}
