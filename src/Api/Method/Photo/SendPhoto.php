<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Method\Photo;

use ServiceBus\HttpClient\InputFilePath;
use ServiceBus\TelegramBot\Api\Method\SendEntity;
use ServiceBus\TelegramBot\Api\Type\Chat\ChatId;
use ServiceBus\TelegramBot\Api\Type\ParseMode;

/**
 * Send photos.
 *
 * @see https://core.telegram.org/bots/api#sendphoto
 */
final class SendPhoto extends SendEntity
{
    /**
     * Photo to send. Pass a file_id as String to send a photo that exists on the Telegram servers (recommended), pass
     * an HTTP URL as a String for Telegram to get a photo from the Internet, or upload a new photo using
     * multipart/form-data.
     *
     * @var InputFilePath|string
     */
    private $photo;

    /**
     * Photo caption (may also be used when resending photos by file_id), 0-1024 characters.
     *
     * @var string|null
     */
    private $caption;

    /**
     * Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in your
     * bot's message.
     *
     * @var ParseMode|null
     */
    private $parseMode;

    /**
     * @param ChatId        $chatId
     * @param InputFilePath $file
     * @param string|null   $caption
     *
     * @return self
     */
    public static function uploadFile(ChatId $chatId, InputFilePath $file, ?string $caption = null): self
    {
        $self = new static($chatId);

        $self->photo   = $file;
        $self->caption = $caption;

        return $self;
    }

    /**
     * @param ChatId      $chatId
     * @param string      $fileId
     * @param string|null $caption
     *
     * @throws \InvalidArgumentException
     *
     * @return self
     *
     */
    public static function withUploadedFile(ChatId $chatId, string $fileId, ?string $caption = null): self
    {
        if ('' === $fileId)
        {
            throw new \InvalidArgumentException('Photo file_id to send must be specified');
        }

        $self = new static($chatId);

        $self->photo   = $fileId;
        $self->caption = $caption;

        return $self;
    }

    /**
     * @return $this
     */
    public function useMarkdown(): self
    {
        $this->parseMode = ParseMode::markdown();

        return $this;
    }

    /**
     * @return $this
     */
    public function useHtml(): self
    {
        $this->parseMode = ParseMode::html();

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function methodName(): string
    {
        return 'sendPhoto';
    }

    /**
     * {@inheritdoc}
     */
    public function requestData(): array
    {
        return \array_filter([
            'chat_id'              => $this->chatId(),
            'disable_notification' => $this->notificationStatus(),
            'reply_to_message_id'  => $this->replyToMessage(),
            'parse_mode'           => null !== $this->parseMode ? $this->parseMode->toString() : null,
            'reply_markup'         => $this->replyMarkup(),
            'photo'                => $this->photo,
            'caption'              => $this->caption,
        ]);
    }
}
