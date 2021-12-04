<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types=0);

namespace ServiceBus\TelegramBot\Api\Method\ChatManage;

use ServiceBus\HttpClient\InputFilePath;
use ServiceBus\TelegramBot\Api\Type\Chat\ChatId;
use ServiceBus\TelegramBot\Api\Type\SimpleSuccessResponse;
use ServiceBus\TelegramBot\Interaction\TelegramMethod;

/**
 * Set a new profile photo for the chat.
 *
 * @see https://core.telegram.org/bots/api#setchatphoto
 */
final class SetChatPhoto implements TelegramMethod
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

    public static function create(ChatId $chatId, InputFilePath $photo): self
    {
        $self = new self();

        $self->chatId = $chatId;
        $self->photo  = $photo;

        return $self;
    }

    public function methodName(): string
    {
        return 'setChatPhoto';
    }

    public function httpRequestMethod(): string
    {
        return 'POST';
    }

    public function requestData(): array
    {
        return [
            'chat_id' => $this->chatId->toString(),
            'photo'   => $this->photo,
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
