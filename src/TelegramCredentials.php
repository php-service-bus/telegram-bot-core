<?php

/**
 * Telegram TelegramBot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot;

/**
 * Telegram bot api credentials.
 *
 * @property-read string $token
 */
final class TelegramCredentials
{
    /**
     * TelegramBot api token.
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
    public static function apiToken(string $token): self
    {
        if ('' === $token)
        {
            throw new \InvalidArgumentException('API token can\'t be empty');
        }

        if (false === (bool) \preg_match('/(\d+)\:[\w\-]+/', $token))
        {
            throw new \InvalidArgumentException('Invalid bot api token (via regular expression "/(\d+)\:[\w\-]+/")');
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
