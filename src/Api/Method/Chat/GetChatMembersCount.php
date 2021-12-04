<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types=0);

namespace ServiceBus\TelegramBot\Api\Method\Chat;

use ServiceBus\TelegramBot\Api\Type\Chat\ChatId;
use ServiceBus\TelegramBot\Api\Type\Chat\ChatMembersCount;
use ServiceBus\TelegramBot\Interaction\TelegramMethod;

/**
 * Get the number of members in a chat.
 *
 * @see https://core.telegram.org/bots/api#getchatmemberscount
 */
final class GetChatMembersCount implements TelegramMethod
{
    /**
     * Unique identifier for the target chat or username of the target supergroup or channel (in the format
     * channelusername).
     *
     * @var ChatId
     */
    private $chatId;

    public static function create(ChatId $chatId): self
    {
        $self = new self();

        $self->chatId = $chatId;

        return $self;
    }

    public function methodName(): string
    {
        return 'getChatMembersCount';
    }

    public function httpRequestMethod(): string
    {
        return 'POST';
    }

    public function requestData(): array
    {
        return [
            'chat_id' => $this->chatId->toString(),
        ];
    }

    public function typeClass(): string
    {
        return ChatMembersCount::class;
    }

    private function __construct()
    {
    }
}
