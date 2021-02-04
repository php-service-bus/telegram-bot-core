<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 0);

namespace ServiceBus\TelegramBot\Api\Method\ChatSticker;

use ServiceBus\TelegramBot\Api\Type\Chat\ChatId;
use ServiceBus\TelegramBot\Api\Type\SimpleSuccessResponse;
use ServiceBus\TelegramBot\Interaction\TelegramMethod;

/**
 * Delete a group sticker set from a supergroup. The bot must be an administrator in the chat for this to work and must
 * have the appropriate admin rights. Use the field can_set_sticker_set optionally returned in getChat requests to
 * check if the bot can use this method.
 *
 * @see https://core.telegram.org/bots/api#deletechatstickerset
 */
final class DeleteChatStickerSet implements TelegramMethod
{
    /**
     * Unique identifier for the target chat or username of the target supergroup (in the format supergroupusername).
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
        return 'deleteChatStickerSet';
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
        return SimpleSuccessResponse::class;
    }

    private function __construct()
    {
    }
}
