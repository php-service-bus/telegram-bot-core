<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Bot;

/**
 * Telegram bot api credentials.
 *
 * @property-read string $token
 */
final class Credentials
{
    /**
     * Bot api token.
     *
     * @see https://core.telegram.org/bots/api#authorizing-your-bot
     *
     * @var string
     */
    public $token;

    /**
     * @param string $token
     *
     * @throws \InvalidArgumentException Invalid api token
     *
     * @return self
     *
     */
    public static function create(string $token): self
    {
        if ('' === $token)
        {
            throw new \InvalidArgumentException('API token can\'t be empty');
        }

        if (false === (bool) \preg_match('/(\d+)\:[\w\-]+/', $token))
        {
            throw new \InvalidArgumentException('Invalid bot api token (via regular expression)');
        }

        return new self($token);
    }

    /**
     * @param string $token
     */
    private function __construct(string $token)
    {
        $this->token = $token;
    }
}
