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

use function ServiceBus\Common\jsonEncode;
use ServiceBus\TelegramBot\Api\Type\Chat\ChatId;
use ServiceBus\TelegramBot\Api\Type\InputMedia\InputMedia;
use ServiceBus\TelegramBot\Api\Type\Message\Message;
use ServiceBus\TelegramBot\Api\Type\Message\MessageId;
use ServiceBus\TelegramBot\Interaction\TelegramMethod;

/**
 * Send a group of photos or videos as an album.
 *
 * @see https://core.telegram.org/bots/api#sendmediagroup
 */
final class SendMediaGroup implements TelegramMethod
{
    /**
     * Unique identifier for the target chat or username of the target channel (in the format channelusername).
     *
     * @var ChatId
     */
    private $chatId;

    /**
     * A JSON-serialized array describing photos and videos to be sent, must include 2–10 items.
     *
     * @var InputMedia[]
     */
    private $media;

    /**
     * Sends the messages silently. Users will receive a notification with no sound.
     *
     * @var bool
     */
    private $disableNotification = true;

    /**
     * If the messages are a reply, ID of the original message.
     *
     * @var MessageId|null
     */
    private $replyToMessageId;

    /**
     * @param InputMedia[] $media
     */
    public static function create(ChatId $chatId, array $media): self
    {
        $self = new self();

        $self->chatId = $chatId;
        $self->media  = $media;

        return $self;
    }

    public function addMedia(InputMedia $media): self
    {
        $this->media[] = $media;

        return $this;
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

    public function replyTo(MessageId $messageId): self
    {
        $this->replyToMessageId = $messageId;

        return $this;
    }

    public function methodName(): string
    {
        return 'sendMediaGroup';
    }

    public function httpRequestMethod(): string
    {
        return 'POST';
    }

    public function requestData(): array
    {
        return \array_filter([
            'chat_id'              => $this->chatId->toString(),
            'media'                => jsonEncode($this->media),
            'disable_notification' => $this->disableNotification,
            'reply_to_message_id'  => $this->replyToMessageId?->toString(),
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
