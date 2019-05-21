<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Method\Chat;

/**
 *
 */
final class ChatInviteLink
{
    /**
     * Invite link for a chat.
     *
     * @var string
     */
    public $value;

    private function __construct()
    {
    }
}
