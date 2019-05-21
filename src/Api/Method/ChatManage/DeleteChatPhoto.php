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

use ServiceBus\TelegramBot\Api\Type\Chat\ChatId;
use ServiceBus\TelegramBot\Api\Type\SimpleSuccessResponse;

/**
 * Delete a chat photo. Photos can't be changed for private chats. The bot must be an administrator in the chat for
 * this to work and must have the appropriate admin rights.
 *
 * @see https://core.telegram.org/bots/api#deletechatphoto
 */
final class DeleteChatPhoto
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
        return 'deleteChatPhoto';
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
