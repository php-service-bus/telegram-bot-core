<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Method\Message;

use function ServiceBus\TelegramBot\Serializer\jsonEncode;
use ServiceBus\TelegramBot\Api\Method\BotCommand;
use ServiceBus\TelegramBot\Api\Type\Chat\ChatId;
use ServiceBus\TelegramBot\Api\Type\InputMedia\InputMedia;
use ServiceBus\TelegramBot\Api\Type\Message\Message;
use ServiceBus\TelegramBot\Api\Type\Message\MessageId;

/**
 * Send a group of photos or videos as an album.
 *
 * @see https://core.telegram.org/bots/api#sendmediagroup
 */
final class SendMediaGroup implements BotCommand
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
     * @param ChatId       $chatId
     * @param InputMedia[] $media
     *
     * @return  self
     */
    public static function create(ChatId $chatId, array $media): self
    {
        $self = new self();

        $self->chatId = $chatId;
        $self->media  = $media;

        return $self;
    }

    /**
     * @param InputMedia $media
     *
     * @return $this
     */
    public function addMedia(InputMedia $media): self
    {
        $this->media[] = $media;

        return $this;
    }

    /**
     * @return $this
     */
    public function disableNotification(): self
    {
        $this->disableNotification = true;

        return $this;
    }

    /**
     * @return $this
     */
    public function enableNotification(): self
    {
        $this->disableNotification = false;

        return $this;
    }

    /**
     * @param MessageId $messageId
     *
     * @return $this
     */
    public function replyTo(MessageId $messageId): self
    {
        $this->replyToMessageId = $messageId;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function methodName(): string
    {
        return 'sendMediaGroup';
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
        return \array_filter([
            'chat_id'              => $this->chatId->toString(),
            'media'                => jsonEncode($this->media),
            'disable_notification' => $this->disableNotification,
            'reply_to_message_id'  => null !== $this->replyToMessageId ? $this->replyToMessageId->toString() : null,
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
