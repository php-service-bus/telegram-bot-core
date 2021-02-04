<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Method\ChatManage;

use ServiceBus\TelegramBot\Api\Type\Chat\ChatId;
use ServiceBus\TelegramBot\Api\Type\SimpleSuccessResponse;
use ServiceBus\TelegramBot\Interaction\TelegramMethod;

/**
 * Change the title of a chat.
 *
 * @see https://core.telegram.org/bots/api#setchattitle
 */
final class SetChatTitle implements TelegramMethod
{
    /**
     * Unique identifier for the target chat or username of the target channel (in the format channelusername).
     *
     * @var ChatId
     */
    private $chatId;

    /**
     * New chat title, 1-255 characters.
     *
     * @var string
     */
    private $title;

    public static function create(ChatId $chatId, string $title): self
    {
        $self = new self();

        $self->chatId = $chatId;
        $self->title  = $title;

        return $self;
    }

    public function methodName(): string
    {
        return 'setChatTitle';
    }

    public function httpRequestMethod(): string
    {
        return 'POST';
    }

    public function requestData(): array
    {
        return [
            'chat_id' => $this->chatId->toString(),
            'title'   => $this->title,
        ];
    }

    public function typeClass(): string
    {
        return SimpleSuccessResponse::class;
    }

    private function __construct()
    {
    }
}
