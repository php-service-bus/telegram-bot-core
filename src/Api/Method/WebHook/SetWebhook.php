<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 0);

namespace ServiceBus\TelegramBot\Api\Method\WebHook;

use ServiceBus\HttpClient\InputFilePath;
use ServiceBus\TelegramBot\Api\Type\SimpleSuccessResponse;
use ServiceBus\TelegramBot\Interaction\TelegramMethod;

/**
 * Use this method to specify a url and receive incoming updates via an outgoing webhook. Whenever there is an update
 * for the bot, we will send an HTTPS POST request to the specified url, containing a JSON-serialized Update. In case
 * of an unsuccessful request, we will give up after a reasonable amount of attempts. Returns True on success.
 *
 * If you'd like to make sure that the Webhook request comes from Telegram, we recommend using a secret path in the
 * URL, e.g. https://www.example.com/<token>. Since nobody else knows your bot‘s token, you can be pretty sure it’s us.
 *
 * @see https://core.telegram.org/bots/api#setwebhook
 */
final class SetWebhook implements TelegramMethod
{
    private const DEFAULT_MAX_CONNECTIONS = 40;

    private const DEFAULT_ALLOWED_UPDATES = [
        'message',
        'edited_message',
        'channel_post',
        'edited_channel_post',
        'inline_query',
        'chosen_inline_result',
        'callback_query',
        'shipping_query',
        'pre_checkout_query',
    ];

    /**
     * Api endpoint route.
     *
     * @var string
     */
    private $url;

    /**
     * Certificate file path.
     *
     * @var string|null
     */
    private $certificateFilePath;

    /**
     * Maximum allowed number of simultaneous HTTPS connections to the webhook for update delivery, 1-100. Defaults to
     * 40. Use lower values to limit the load on your bot‘s server, and higher values to increase your bot’s
     * throughput.
     *
     * @var int
     */
    private $maxConnections = self::DEFAULT_MAX_CONNECTIONS;

    /**
     * List the types of updates you want your bot to receive. For example, specify [“message”, “edited_channel_post”,
     * “callback_query”] to only receive updates of these types. See Update for a complete list of available update
     * types. Specify an empty list to receive all updates regardless of type (default). If not specified, the previous
     * setting will be used.
     *
     * @var array
     */
    private $allowedUpdates = self::DEFAULT_ALLOWED_UPDATES;

    public static function create(string $url, string $certificateFilePath = null): self
    {
        $self = new self();

        $self->url                 = $url;
        $self->certificateFilePath = $certificateFilePath;

        return $self;
    }

    public function setupMaxConnections(int $maxConnections): void
    {
        $this->maxConnections = $maxConnections;
    }

    public function replaceAllowedUpdates(array $allowedUpdates): void
    {
        $this->allowedUpdates = $allowedUpdates;
    }

    public function methodName(): string
    {
        return 'setWebhook';
    }

    public function httpRequestMethod(): string
    {
        return 'POST';
    }

    public function requestData(): array
    {
        return \array_filter([
            'url'             => $this->url,
            'certificate'     =>  (string) $this->certificateFilePath !== ''
                ? new InputFilePath((string) $this->certificateFilePath)
                : null,
            'max_connections' => $this->maxConnections,
            'allowed_updates' => \implode(', ', \array_values($this->allowedUpdates)),
        ]);
    }

    public function typeClass(): string
    {
        return SimpleSuccessResponse::class;
    }

    private function __construct()
    {
    }
}
