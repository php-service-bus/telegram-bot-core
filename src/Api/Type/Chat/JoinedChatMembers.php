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

use ServiceBus\TelegramBot\Api\Type\User\UserCollection;

/**
 * Represents joined members.
 *
 * @property-read Chat           $chat
 * @property-read UserCollection $members
 */
final class JoinedChatMembers
{
    /**
     * Chat info.
     *
     * @var Chat
     */
    public $chat;

    /**
     * Joined members.
     *
     * @var UserCollection
     */
    public $members;

    /**
     * @param Chat           $chat
     * @param UserCollection $members
     *
     * @return self
     */
    public static function create(Chat $chat, UserCollection $members): self
    {
        return new self($chat, $members);
    }

    /**
     * @param Chat           $chat
     * @param UserCollection $members
     */
    private function __construct(Chat $chat, UserCollection $members)
    {
        $this->chat    = $chat;
        $this->members = $members;
    }
}
