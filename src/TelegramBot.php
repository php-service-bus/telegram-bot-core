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
 * @psalm-readonly
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
     * @throws \InvalidArgumentException
     */
    public function __construct(string $username)
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

        $this->username = $username;
    }
}
