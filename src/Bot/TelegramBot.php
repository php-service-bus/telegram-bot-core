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
 * Bot data.
 *
 * @property-read string      $username
 * @property-read Credentials $credentials
 */
final class TelegramBot
{
    /**
     * Bot username.
     *
     * @var string
     */
    public $username;

    /**
     * Bot api credentials.
     *
     * @var Credentials
     */
    public $credentials;

    /**
     * @param string      $username
     * @param Credentials $credentials
     *
     * @throws \InvalidArgumentException Incorrect bot username
     *
     * @return self
     *
     */
    public static function create(string $username, Credentials $credentials): self
    {
        if ('' === $username)
        {
            throw new \InvalidArgumentException('Bot username can\'t be empty');
        }

        $username = \sprintf('@%s', \ltrim($username, '@'));

        if ('bot' !== \strtolower((string) \substr($username, -3)))
        {
            throw new \InvalidArgumentException(
                'Bot username must end in `Bot` (Like this, for example: TetrisBot or tetris_bot)'
            );
        }

        return new self($username, $credentials);
    }

    /**
     * @param string      $username
     * @param Credentials $credentials
     */
    private function __construct(string $username, Credentials $credentials)
    {
        $this->username    = $username;
        $this->credentials = $credentials;
    }
}
