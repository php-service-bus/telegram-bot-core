<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types=0);

namespace ServiceBus\TelegramBot\Api\Type\Chat;

use ServiceBus\TelegramBot\Api\Type\User\UserCollection;

/**
 * Represents joined members.
 *
 * @psalm-immutable
 */
final class JoinedChatMembers
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
     * Joined members.
     *
     * @psalm-readonly
     *
     * @var UserCollection
     */
    public $members;

    public static function create(Chat $chat, UserCollection $members): self
    {
        return new self($chat, $members);
    }

    private function __construct(Chat $chat, UserCollection $members)
    {
        $this->chat    = $chat;
        $this->members = $members;
    }
}
