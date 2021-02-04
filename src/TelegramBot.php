<?php

/**
 * Telegram TelegramBot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 0);

namespace ServiceBus\TelegramBot;

/**
 * TelegramBot data.
 *
 * @psalm-immutable
 */
final class TelegramBot
{
    /**
     * TelegramBot username.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $username;

    /**
     * @throws \InvalidArgumentException
     */
    public function __construct(string $username)
    {
        if ($username === '')
        {
            throw new \InvalidArgumentException('TelegramBot username can\'t be empty');
        }

        $username = \sprintf('@%s', \ltrim($username, '@'));

        if (\strtolower(\substr($username, -3)) !== 'bot')
        {
            throw new \InvalidArgumentException(
                'TelegramBot username must end in `TelegramBot` (Like this, for example: TetrisBot or tetris_bot)'
            );
        }

        $this->username = $username;
    }
}
