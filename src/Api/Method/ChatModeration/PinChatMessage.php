<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types=0);

namespace ServiceBus\TelegramBot\Api\Method\ChatModeration;

use ServiceBus\TelegramBot\Api\Type\Chat\ChatId;
use ServiceBus\TelegramBot\Api\Type\Message\MessageId;
use ServiceBus\TelegramBot\Api\Type\SimpleSuccessResponse;
use ServiceBus\TelegramBot\Interaction\TelegramMethod;

/**
 * Pin a message in a group, a supergroup, or a channel.
 *
 * @see https://core.telegram.org/bots/api#pinchatmessage
 */
final class PinChatMessage implements TelegramMethod
{
    /**
     * Unique identifier for the target chat or username of the target channel (in the format channelusername).
     *
     * @var ChatId
     */
    private $chatId;

    /**
     * Identifier of a message to pin.
     *
     * @var MessageId
     */
    private $messageId;

    /**
     * Pass True, if it is not necessary to send a notification to all chat members about the new pinned message.
     * Notifications are always disabled in channels.
     *
     * @var bool
     */
    private $disableNotification = true;

    public static function create(ChatId $chatId, MessageId $messageId): self
    {
        $self = new self();

        $self->chatId    = $chatId;
        $self->messageId = $messageId;

        return $self;
    }

    public function notifyMembers(): self
    {
        $this->disableNotification = false;

        return $this;
    }

    public function disallowMembersNotification(): self
    {
        $this->disableNotification = true;

        return $this;
    }

    public function methodName(): string
    {
        return 'pinChatMessage';
    }

    public function httpRequestMethod(): string
    {
        return 'POST';
    }

    public function requestData(): array
    {
        return [
            'chat_id'              => $this->chatId->toString(),
            'message_id'           => $this->messageId->toString(),
            'disable_notification' => $this->disableNotification,
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
