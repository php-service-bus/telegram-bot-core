<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Type\Chat;

use ServiceBus\TelegramBot\Api\Type\User\User;

/**
 * Represents left user.
 *
 * @psalm-immutable
 */
final class LeftChatMember
{
    /**
     * Chat info.
     *
     * @psalm-readonly
     *
     * @var Chat
     */
    public $chat;

    /**
     * User info.
     *
     * @psalm-readonly
     *
     * @var User
     */
    public $user;

    public static function create(Chat $chat, User $user): self
    {
        return new self($chat, $user);
    }

    private function __construct(Chat $chat, User $user)
    {
        $this->chat = $chat;
        $this->user = $user;
    }
}
