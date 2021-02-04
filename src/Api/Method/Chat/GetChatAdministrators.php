<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Method\Chat;

use ServiceBus\TelegramBot\Api\Type\Chat\ChatId;
use ServiceBus\TelegramBot\Api\Type\Chat\ChatMemberCollection;
use ServiceBus\TelegramBot\Interaction\TelegramMethod;

/**
 * Get a list of administrators in a chat.
 *
 * @see https://core.telegram.org/bots/api#getchatadministrators
 */
final class GetChatAdministrators implements TelegramMethod
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
        return 'getChatAdministrators';
    }

    public function httpRequestMethod(): string
    {
        return 'POST';
    }

    public function requestData(): array
    {
        return ['chat_id' => $this->chatId->toString()];
    }

    public function typeClass(): string
    {
        return ChatMemberCollection::class;
    }

    private function __construct()
    {
    }
}
