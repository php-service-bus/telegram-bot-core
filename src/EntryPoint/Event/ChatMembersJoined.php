<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\EntryPoint\Event;

use ServiceBus\TelegramBot\Api\Type\Chat\JoinedChatMembers;
use ServiceBus\TelegramBot\Api\Type\Update;
use ServiceBus\TelegramBot\Api\Type\User\UserCollection;

/**
 * A new members joined the chat.
 */
final class ChatMembersJoined implements TelegramEvent
{
    /**
     * @var JoinedChatMembers
     */
    private $joinedChatMembers;

    /**
     * {@inheritdoc}
     */
    public static function supports(Update $update): bool
    {
        return null !== $update->message && null !== $update->message->chat && 0 !== \count($update->message->newChatMembers);
    }

    /**
     * {@inheritdoc}
     */
    public static function fromUpdate(Update $update): TelegramEvent
    {
        if (null !== $update->message && null !== $update->message->chat && 0 !== \count($update->message->newChatMembers))
        {
            $message = $update->message;

            return new self(
                JoinedChatMembers::create(
                    $message->chat,
                    UserCollection::create($message->newChatMembers)
                )
            );
        }

        throw new \LogicException('Incorrect update passed');
    }

    /**
     * {@inheritdoc}
     *
     * @return JoinedChatMembers
     */
    public function payload(): object
    {
        return $this->joinedChatMembers;
    }

    /**
     * @param JoinedChatMembers $joinedChatMembers
     */
    private function __construct(JoinedChatMembers $joinedChatMembers)
    {
        $this->joinedChatMembers = $joinedChatMembers;
    }
}
