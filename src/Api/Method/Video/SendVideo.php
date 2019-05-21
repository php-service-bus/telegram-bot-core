<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Method\Video;

use ServiceBus\HttpClient\InputFilePath;
use ServiceBus\TelegramBot\Api\Method\SendEntity;
use ServiceBus\TelegramBot\Api\Type\Chat\ChatId;
use ServiceBus\TelegramBot\Api\Type\ParseMode;

/**
 * Send video files, Telegram clients support mp4 videos (other formats may be sent as Document).
 *
 * @see https://core.telegram.org/bots/api#sendvideo
 */
final class SendVideo extends SendEntity
{
    /**
     * Video to send. Pass a file_id as String to send a video that exists on the Telegram servers (recommended), pass
     * an HTTP URL as a String for Telegram to get a video from the Internet, or upload a new video using
     * multipart/form-data.
     *
     * @var InputFilePath|string
     */
    private $video;

    /**
     * Duration of sent video in seconds.
     *
     * @var int|null
     */
    private $duration;

    /**
     * Video width.
     *
     * @var int|null
     */
    private $width;

    /**
     * Video height.
     *
     * @var int|null
     */
    private $height;

    /**
     * Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side. The
     * thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail‘s width and height should not
     * exceed 320. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can’t be reused and can be
     * only uploaded as a new file, so you can pass “attach://<file_attach_name>” if the thumbnail was uploaded using
     * multipart/form-data under <file_attach_name>.
     *
     * @var  InputFilePath|string|null
     */
    private $thumb;

    /**
     * Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in your
     * bot's message.
     *
     * @var ParseMode|null
     */
    private $parseMode;

    /**
     * Video caption (may also be used when resending videos by file_id), 0-1024 characters.
     *
     * @var string|null
     */
    private $caption;

    /**
     * Pass True, if the uploaded video is suitable for streaming.
     *
     * @var bool
     */
    private $supportsStreaming = false;

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

        $self->video   = $file;
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
            throw new \InvalidArgumentException('Video file_id to send must be specified');
        }

        $self = new static($chatId);

        $self->video   = $fileId;
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
     * @return $this
     */
    public function enableStreaming(): self
    {
        $this->supportsStreaming = true;

        return $this;
    }

    /**
     * @return $this
     */
    public function disableStreaming(): self
    {
        $this->supportsStreaming = false;

        return $this;
    }

    /**
     * @param InputFilePath $thumb
     *
     * @return self
     */
    public function uploadThumbFile(InputFilePath $thumb): self
    {
        $this->thumb = $thumb;

        return $this;
    }

    /**
     * @param string $thumbFileId
     *
     * @throws \InvalidArgumentException
     *
     * @return self
     *
     */
    public function useUploadedThumb(string $thumbFileId): self
    {
        if ('' === $thumbFileId)
        {
            throw new \InvalidArgumentException('Thumb file_id must be specified');
        }

        $this->thumb = $thumbFileId;

        return $this;
    }

    /**
     * @return $this
     */
    public function removeThumb(): self
    {
        $this->thumb = null;

        return $this;
    }

    /**
     * @param int $duration
     *
     * @return $this
     */
    public function setupDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @return $this
     */
    public function unsetDuration(): self
    {
        $this->duration = null;

        return $this;
    }

    /**
     * @param int $width
     * @param int $height
     *
     * @return $this
     */
    public function setupSize(int $width, int $height): self
    {
        $this->width  = $width;
        $this->height = $height;

        return $this;
    }

    /**
     * @return $this
     */
    public function unsetSize(): self
    {
        $this->width  = null;
        $this->height = null;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function methodName(): string
    {
        return 'SendVideo';
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
            'video'                => $this->video,
            'thumb'                => $this->thumb,
            'duration'             => $this->duration,
            'caption'              => $this->caption,
            'width'                => $this->width,
            'height'               => $this->height,
        ]);
    }
}
