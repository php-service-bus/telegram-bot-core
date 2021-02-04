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

use ServiceBus\TelegramBot\Api\Type\WebhookInfo;
use ServiceBus\TelegramBot\Interaction\TelegramMethod;

/**
 * Get current webhook status.
 *
 * @see https://core.telegram.org/bots/api#getwebhookinfo
 */
final class GetWebHookInfo implements TelegramMethod
{
    public static function create(): self
    {
        return new self();
    }

    public function methodName(): string
    {
        return 'getWebhookInfo';
    }

    public function httpRequestMethod(): string
    {
        return 'GET';
    }

    public function requestData(): array
    {
        return [];
    }

    public function typeClass(): string
    {
        return WebhookInfo::class;
    }

    private function __construct()
    {
    }
}
