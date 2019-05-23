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
 * TelegramBot data.
 *
 * @property-read string $username
 */
final class TelegramBot
{
    /**
     * TelegramBot username.
     *
     * @var string
     */
    public $username;

    /**
     * @param string $username
     *
     * @return self
     */
    public static function create(string $username): self
    {
        if ('' === $username)
        {
            throw new \InvalidArgumentException('TelegramBot username can\'t be empty');
        }

        $username = \sprintf('@%s', \ltrim($username, '@'));

        if ('bot' !== \strtolower((string) \substr($username, -3)))
        {
            throw new \InvalidArgumentException(
                'TelegramBot username must end in `TelegramBot` (Like this, for example: TetrisBot or tetris_bot)'
            );
        }

        return new self($username);
    }

    /**
     * @param string $username
     */
    private function __construct(string $username)
    {
        $this->username = $username;
    }
}
