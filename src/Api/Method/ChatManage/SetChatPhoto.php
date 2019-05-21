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

use ServiceBus\HttpClient\InputFilePath;
use ServiceBus\TelegramBot\Api\Method\BotCommand;
use ServiceBus\TelegramBot\Api\Type\Chat\ChatId;
use ServiceBus\TelegramBot\Api\Type\SimpleSuccessResponse;

/**
 * Set a new profile photo for the chat.
 *
 * @see https://core.telegram.org/bots/api#setchatphoto
 */
final class SetChatPhoto implements BotCommand
{
    /**
     * Unique identifier for the target chat or username of the target supergroup or channel (in the format
     * channelusername).
     *
     * @var ChatId
     */
    private $chatId;

    /**
     * New chat photo, uploaded using multipart/form-data.
     *
     * @var InputFilePath
     */
    private $photo;

    /**
     * @param ChatId        $chatId
     * @param InputFilePath $photo
     *
     * @return self
     */
    public static function create(ChatId $chatId, InputFilePath $photo): self
    {
        $self = new self();

        $self->chatId = $chatId;
        $self->photo  = $photo;

        return $self;
    }

    /**
     * {@inheritdoc}
     */
    public function methodName(): string
    {
        return 'setChatPhoto';
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
            'photo'   => $this->photo,
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
