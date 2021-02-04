<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 0);

namespace ServiceBus\TelegramBot\Api\Method\Message;

use ServiceBus\TelegramBot\Api\Type\Chat\ChatId;
use ServiceBus\TelegramBot\Api\Type\Message\Message;
use ServiceBus\TelegramBot\Api\Type\Message\MessageId;
use ServiceBus\TelegramBot\Interaction\TelegramMethod;

/**
 * Forward messages of any kind.
 *
 * @see https://core.telegram.org/bots/api#forwardmessage
 */
final class ForwardMessage implements TelegramMethod
{
    /**
     * Unique identifier for the chat where the original message was sent (or channel username in the format
     * channelusername).
     *
     * @var ChatId
     */
    private $fromChatId;

    /**
     * Unique identifier for the target chat or username of the target channel (in the format channelusername).
     *
     * @var ChatId
     */
    private $toChatId;

    /**
     * Message identifier in the chat specified in from_chat_id.
     *
     * @var MessageId
     */
    private $messageId;

    /**
     * Sends the message silently. Users will receive a notification with no sound.
     *
     * @var bool
     */
    private $disableNotification = true;

    public static function create(ChatId $fromChatId, ChatId $toChatId, MessageId $messageId): self
    {
        $self = new self();

        $self->fromChatId = $fromChatId;
        $self->toChatId   = $toChatId;
        $self->messageId  = $messageId;

        return $self;
    }

    public function disableNotification(): self
    {
        $this->disableNotification = true;

        return $this;
    }

    public function enableNotification(): self
    {
        $this->disableNotification = false;

        return $this;
    }

    public function methodName(): string
    {
        return 'forwardMessage';
    }

    public function httpRequestMethod(): string
    {
        return 'POST';
    }

    public function requestData(): array
    {
        return \array_filter([
            'chat_id'              => $this->toChatId->toString(),
            'from_chat_id'         => $this->fromChatId->toString(),
            'message_id'           => $this->messageId->toString(),
            'disable_notification' => $this->disableNotification,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function typeClass(): string
    {
        return Message::class;
    }

    private function __construct()
    {
    }
}
