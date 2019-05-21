<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Method\ChatManage;

use ServiceBus\TelegramBot\Api\Method\BotCommand;
use ServiceBus\TelegramBot\Api\Type\Chat\ChatId;
use ServiceBus\TelegramBot\Api\Type\SimpleSuccessResponse;

/**
 * Change the description of a supergroup or a channel. The bot must be an administrator in the chat for this to work
 * and must have the appropriate admin rights.
 *
 * @see https://core.telegram.org/bots/api#setchatdescription
 */
final class SetChatDescription implements BotCommand
{
    /**
     * Unique identifier for the target chat or username of the target channel (in the format channelusername).
     *
     * @var ChatId
     */
    private $chatId;

    /**
     * New chat description, 0-255 characters.
     *
     * @var string|null
     */
    private $description;

    /**
     * @param ChatId $chatId
     * @param string $description
     *
     * @return self
     */
    public static function create(ChatId $chatId, string $description): self
    {
        $self = new self();

        $self->chatId      = $chatId;
        $self->description = $description;

        return $self;
    }

    /**
     * {@inheritdoc}
     */
    public function methodName(): string
    {
        return 'setChatDescription';
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
            'chat_id'     => $this->chatId->toString(),
            'description' => (string) $this->description,
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
