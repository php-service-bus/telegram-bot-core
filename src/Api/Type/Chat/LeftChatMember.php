<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Type\Chat;

use ServiceBus\TelegramBot\Api\Type\User\User;

/**
 * Represents left user.
 *
 * @psalm-readonly
 */
final class LeftChatMember
{
    /**
     * Chat info.
     *
     * @var Chat
     */
    public $chat;

    /**
     * User info.
     *
     * @var User
     */
    public $user;

    /**
     * @param Chat $chat
     * @param User $user
     *
     * @return self
     */
    public static function create(Chat $chat, User $user): self
    {
        return new self($chat, $user);
    }

    /**
     * @param Chat $chat
     * @param User $user
     */
    private function __construct(Chat $chat, User $user)
    {
        $this->chat = $chat;
        $this->user = $user;
    }
}
