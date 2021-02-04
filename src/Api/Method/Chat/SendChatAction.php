<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 0);

namespace ServiceBus\TelegramBot\Api\Method\Chat;

use ServiceBus\TelegramBot\Api\Type\Chat\ChatId;
use ServiceBus\TelegramBot\Api\Type\SimpleSuccessResponse;
use ServiceBus\TelegramBot\Interaction\TelegramMethod;

/**
 * Use this method when you need to tell the user that something is happening on the bot's side. The status is set for
 * 5 seconds or less (when a message arrives from your bot, Telegram clients clear its typing status).
 *
 * @see https://core.telegram.org/bots/api#sendchataction
 */
final class SendChatAction implements TelegramMethod
{
    /**
     * Unique identifier for the target chat or username of the target channel (in the format channelusername).
     *
     * @var ChatId
     */
    private $chatId;

    /**
     * Type of action to broadcast. Choose one, depending on what the user is about to receive.
     *
     * @var BroadcastType
     */
    private $action;

    public static function create(ChatId $chatId, BroadcastType $action): self
    {
        $self = new self();

        $self->chatId = $chatId;
        $self->action = $action;

        return $self;
    }

    public function methodName(): string
    {
        return 'sendChatAction';
    }

    public function httpRequestMethod(): string
    {
        return 'POST';
    }

    public function requestData(): array
    {
        return [
            'chat_id' => $this->chatId->toString(),
            'action'  => $this->action->toString(),
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
