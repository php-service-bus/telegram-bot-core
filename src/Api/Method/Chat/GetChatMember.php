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

use ServiceBus\TelegramBot\Api\Type\Chat\ChatId;
use ServiceBus\TelegramBot\Api\Type\Chat\ChatMember;
use ServiceBus\TelegramBot\Api\Type\User\UserId;
use ServiceBus\TelegramBot\Interaction\TelegramMethod;

/**
 * Get information about a member of a chat.
 *
 * @see https://core.telegram.org/bots/api#getchatmember
 */
final class GetChatMember implements TelegramMethod
{
    /**
     * Unique identifier for the target chat or username of the target supergroup or channel (in the format
     * channelusername).
     *
     * @var ChatId
     */
    private $chatId;

    /**
     * Unique identifier of the target user.
     *
     * @var UserId
     */
    private $userId;

    /**
     * @param ChatId $chatId
     * @param UserId $userId
     *
     * @return self
     */
    public static function create(ChatId $chatId, UserId $userId): self
    {
        $self = new self();

        $self->chatId = $chatId;
        $self->userId = $userId;

        return $self;
    }

    /**
     * {@inheritdoc}
     */
    public function methodName(): string
    {
        return 'getChatMember';
    }

    /**
     * {@inheritdoc}
     */
    public function httpRequestMethod(): string
    {
        return 'POST';
    }

    /**
     * {@inheritdoc}
     */
    public function requestData(): array
    {
        return [
            'chat_id' => $this->chatId->toString(),
            'user_id' => $this->userId->toString(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function typeClass(): string
    {
        return ChatMember::class;
    }

    private function __construct()
    {
    }
}
