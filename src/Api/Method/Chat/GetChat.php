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

use ServiceBus\TelegramBot\Api\Method\BotCommand;
use ServiceBus\TelegramBot\Api\Type\Chat\Chat;
use ServiceBus\TelegramBot\Api\Type\Chat\ChatId;

/**
 * Get up to date information about the chat.
 *
 * @see https://core.telegram.org/bots/api#getchat
 */
final class GetChat implements BotCommand
{
    /**
     * Unique identifier for the target chat or username of the target supergroup or channel (in the format
     * channelusername).
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
        return 'getChat';
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
        return ['chat_id' => $this->chatId->toString()];
    }

    /**
     * {@inheritdoc}
     */
    public function typeClass(): string
    {
        return Chat::class;
    }

    private function __construct()
    {
    }
}