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

use ServiceBus\TelegramBot\Api\Type\SimpleSuccessResponse;
use ServiceBus\TelegramBot\Interaction\TelegramMethod;

/**
 * Remove webhook integration if you decide to switch back to getUpdates.
 *
 * @see https://core.telegram.org/bots/api#deletewebhook
 */
final class DeleteWebhook implements TelegramMethod
{
    public static function create(): self
    {
        return new self();
    }

    public function methodName(): string
    {
        return 'deleteWebhook';
    }

    public function httpRequestMethod(): string
    {
        return 'POST';
    }

    public function requestData(): array
    {
        return [];
    }

    public function typeClass(): string
    {
        return SimpleSuccessResponse::class;
    }

    private function __construct()
    {
    }
}
