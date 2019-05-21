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
use ServiceBus\TelegramBot\Api\Type\WebhookInfo;

/**
 * Get current webhook status.
 *
 * @see https://core.telegram.org/bots/api#getwebhookinfo
 */
final class GetWebHookInfo implements BotCommand
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
        return 'getWebhookInfo';
    }

    /**
     * {@inheritdoc}
     */
    public function httpRequestMethod(): string
    {
        return 'GET';
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
        return WebhookInfo::class;
    }

    private function __construct()
    {
    }
}
