<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Method\WebHook;

use ServiceBus\TelegramBot\Api\Method\BotCommand;
use ServiceBus\TelegramBot\Api\Type\SimpleSuccessResponse;

/**
 * Remove webhook integration if you decide to switch back to getUpdates.
 *
 * @see https://core.telegram.org/bots/api#deletewebhook
 */
final class DeleteWebhook implements BotCommand
{
    /**
     * @return self
     */
    public static function create(): self
    {
        return new self();
    }

    /**
     * {@inheritdoc}
     */
    public function methodName(): string
    {
        return 'deleteWebhook';
    }

    /**
     * {@inheritdoc}
     */
    public function httpRequestMethod(): string
    {
        return 'POST';
    }

    /**
     * {@inheritdoc}
     */
    public function requestData(): array
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function typeClass(): string
    {
        return SimpleSuccessResponse::class;
    }

    private function __construct()
    {
    }
}
