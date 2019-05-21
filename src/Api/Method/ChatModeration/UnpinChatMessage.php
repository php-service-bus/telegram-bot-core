<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Method\ChatModeration;

use ServiceBus\TelegramBot\Api\Method\BotCommand;
use ServiceBus\TelegramBot\Api\Type\Chat\ChatId;
use ServiceBus\TelegramBot\Api\Type\SimpleSuccessResponse;

/**
 * Unpin a message in a group, a supergroup, or a channel.
 *
 * @see https://core.telegram.org/bots/api#unpinchatmessage
 */
final class UnpinChatMessage implements BotCommand
{
    /**
     * Unique identifier for the target chat or username of the target channel (in the format channelusername).
     *
     * @var ChatId
     */
    private $chatId;

    /**
     * @param ChatId $chatId
     *
     * @return self
     */
    public static function create(ChatId $chatId): self
    {
        $self = new self();

        $self->chatId = $chatId;

        return $self;
    }

    /**
     * {@inheritdoc}
     */
    public function methodName(): string
    {
        return 'unpinChatMessage';
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
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function typeClass(): string
    {
        return SimpleSuccessResponse::class;
    }

    private function __construct()
    {
    }
}
