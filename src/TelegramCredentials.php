<?php

/**
 * Telegram TelegramBot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types=0);

namespace ServiceBus\TelegramBot;

/**
 * Telegram bot api credentials.
 *
 * @psalm-immutable
 */
final class TelegramCredentials
{
    /**
     * TelegramBot api token.
     *
     * @psalm-readonly
     * @psalm-var non-empty-string
     *
     * @see https://core.telegram.org/bots/api#authorizing-your-bot
     *
     * @var string
     */
    public $token;

    /**
     * @throws \InvalidArgumentException Invalid api token
     */
    public function __construct(string $token)
    {
        if ($token === '')
        {
            throw new \InvalidArgumentException('API token can\'t be empty');
        }

        if ((bool) \preg_match('/(\d+):[\w\-]+/', $token) === false)
        {
            throw new \InvalidArgumentException('Invalid bot api token (via regular expression "/(\d+)\:[\w\-]+/")');
        }

        $this->token = $token;
    }
}
