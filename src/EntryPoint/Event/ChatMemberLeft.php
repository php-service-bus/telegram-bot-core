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

use ServiceBus\TelegramBot\Api\Type\Chat\LeftChatMember;
use ServiceBus\TelegramBot\Api\Type\Update;

/**
 * Member left the chat.
 *
 * @psalm-readonly
 */
final class ChatMemberLeft implements TelegramEvent
{
    /**
     * @var LeftChatMember
     */
    public $leftChatMember;

    /**
     * {@inheritdoc}
     */
    public static function supports(Update $update): bool
    {
        return null !== $update->message && null !== $update->message->chat && null !== $update->message->leftChatMember;
    }

    /**
     * {@inheritdoc}
     */
    public static function fromUpdate(Update $update): TelegramEvent
    {
        if (null !== $update->message && null !== $update->message->chat && null !== $update->message->leftChatMember)
        {
            return new self(LeftChatMember::create($update->message->chat, $update->message->leftChatMember));
        }

        throw new \LogicException('Incorrect update passed');
    }

    /**
     * {@inheritdoc}
     *
     * @return LeftChatMember
     */
    public function payload(): object
    {
        return $this->leftChatMember;
    }

    /**
     * @param LeftChatMember $leftChatMember
     */
    private function __construct(LeftChatMember $leftChatMember)
    {
        $this->leftChatMember = $leftChatMember;
    }
}
