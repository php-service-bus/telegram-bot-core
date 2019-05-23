<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Method;

use ServiceBus\TelegramBot\Api\Type\User\User;
use ServiceBus\TelegramBot\Interaction\TelegramMethod;

/**
 * A simple method for testing your bot's auth token. Requires no parameters. Returns basic information about the bot
 * in form of a User object.
 *
 * @see https://core.telegram.org/bots/api#getme
 */
final class GetMe implements TelegramMethod
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
        return 'getMe';
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
        return User::class;
    }

    private function __construct()
    {
    }
}
