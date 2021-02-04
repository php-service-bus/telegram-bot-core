<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 0);

namespace ServiceBus\TelegramBot\Api\Method\Video;

use ServiceBus\HttpClient\InputFilePath;
use ServiceBus\TelegramBot\Api\Method\SendEntity;
use ServiceBus\TelegramBot\Api\Type\Chat\ChatId;
use ServiceBus\TelegramBot\Api\Type\ParseMode;

/**
 * As of v.4.0, Telegram clients support rounded square mp4 videos of up to 1 minute long. Use this method to send
 * video messages.
 *
 * @see https://core.telegram.org/bots/api#sendvideonote
 */
final class SendVideoNote extends SendEntity
{
    /**
     * Video note to send. Pass a file_id as String to send a video note that exists on the Telegram servers
     * (recommended) or upload a new video using multipart/form-data. More info on Sending Files ».
     *
     * @var InputFilePath|string
     */
    private $videoNote;

    /**
     * Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in your
     * bot's message.
     *
     * @var ParseMode|null
     */
    private $parseMode;

    /**
     * Duration of sent video in seconds.
     *
     * @var int|null
     */
    private $duration;

    /**
     * Video width and height, i.e. diameter of the video message.
     *
     * @var int|null
     */
    private $length;

    /**
     * Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side. The
     * thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail‘s width and height should not
     * exceed 320. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can’t be reused and can be
     * only uploaded as a new file, so you can pass “attach://<file_attach_name>” if the thumbnail was uploaded using
     * multipart/form-data under <file_attach_name>.
     *
     * @var InputFilePath|string|null
     */
    private $thumb;

    public static function uploadFile(ChatId $chatId, InputFilePath $file): self
    {
        $self = new self($chatId);

        $self->videoNote = $file;

        return $self;
    }

    /**
     * @throws \InvalidArgumentException
     */
    public static function withUploadedFile(ChatId $chatId, string $fileId): self
    {
        if ($fileId === '')
        {
            throw new \InvalidArgumentException('Video note file_id to send must be specified');
        }

        $self = new self($chatId);

        $self->videoNote = $fileId;

        return $self;
    }

    public function useMarkdown(): self
    {
        $this->parseMode = ParseMode::markdown();

        return $this;
    }

    public function useHtml(): self
    {
        $this->parseMode = ParseMode::html();

        return $this;
    }

    public function uploadThumbFile(InputFilePath $thumb): self
    {
        $this->thumb = $thumb;

        return $this;
    }

    /**
     * @throws \InvalidArgumentException
     */
    public function useUploadedThumb(string $thumbFileId): self
    {
        if ($thumbFileId === '')
        {
            throw new \InvalidArgumentException('Thumb file_id must be specified');
        }

        $this->thumb = $thumbFileId;

        return $this;
    }

    public function removeThumb(): self
    {
        $this->thumb = null;

        return $this;
    }

    public function setupDuration(int $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    public function unsetDuration(): self
    {
        $this->duration = null;

        return $this;
    }

    public function setupLength(int $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function unsetLength(): self
    {
        $this->length = null;

        return $this;
    }

    public function methodName(): string
    {
        return 'sendVideoNote';
    }

    public function requestData(): array
    {
        return \array_filter([
            'chat_id'              => $this->chatId(),
            'disable_notification' => $this->notificationStatus(),
            'reply_to_message_id'  => $this->replyToMessage(),
            'parse_mode'           => $this->parseMode?->toString(),
            'reply_markup'         => $this->replyMarkup(),
            'video_note'           => $this->videoNote,
            'thumb'                => $this->thumb,
            'duration'             => $this->duration,
            'length'               => $this->length,
        ]);
    }
}
