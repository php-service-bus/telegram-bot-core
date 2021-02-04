<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Method\Audio;

use ServiceBus\HttpClient\InputFilePath;
use ServiceBus\TelegramBot\Api\Method\SendEntity;
use ServiceBus\TelegramBot\Api\Type\Chat\ChatId;
use ServiceBus\TelegramBot\Api\Type\ParseMode;

/**
 * Send audio files, if you want Telegram clients to display them in the music player. Your audio must be in the .mp3
 * format. On success, the sent Message is returned. Bots can currently send audio files of up to 50 MB in size, this
 * limit may be changed in the future.
 *
 * For sending voice messages, use the sendVoice method instead.
 *
 * @see https://core.telegram.org/bots/api#sendaudio
 */
final class SendAudio extends SendEntity
{
    /**
     * Audio file to send. Pass a file_id as String to send an audio file that exists on the Telegram servers
     * (recommended), pass an HTTP URL as a String for Telegram to get an audio file from the Internet, or upload a new
     * one using multipart/form-data.
     *
     * @var InputFilePath|string
     */
    private $audio;

    /**
     * Audio caption, 0-1024 characters.
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
     * Duration of the audio in seconds.
     *
     * @var int|null
     */
    private $duration;

    /**
     * Performer.
     *
     * @var string|null
     */
    private $performer;

    /**
     * Track name.
     *
     * @var string|null
     */
    private $title;

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

    public static function uploadFile(
        ChatId $chatId,
        InputFilePath $file,
        ?string $title = null,
        ?string $caption = null
    ): self {
        $self = new self($chatId);

        $self->audio   = $file;
        $self->title   = $title;
        $self->caption = $caption;

        return $self;
    }

    /**
     * @throws \InvalidArgumentException
     */
    public static function withUploadedFile(
        ChatId $chatId,
        string $fileId,
        ?string $title = null,
        ?string $caption = null
    ): self {
        if ($fileId === '')
        {
            throw new \InvalidArgumentException('Audio file_id to send must be specified');
        }

        $self = new self($chatId);

        $self->audio   = $fileId;
        $self->title   = $title;
        $self->caption = $caption;

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

    public function setupPerformer(string $performer): self
    {
        $this->performer = $performer;

        return $this;
    }

    public function unsetPerformer(): self
    {
        $this->performer = null;

        return $this;
    }

    public function methodName(): string
    {
        return 'sendAudio';
    }

    public function requestData(): array
    {
        return \array_filter([
            'chat_id'              => $this->chatId(),
            'disable_notification' => $this->notificationStatus(),
            'reply_to_message_id'  => $this->replyToMessage(),
            'parse_mode'           => $this->parseMode?->toString(),
            'reply_markup'         => $this->replyMarkup(),
            'audio'                => $this->audio,
            'thumb'                => $this->thumb,
            'duration'             => $this->duration,
            'performer'            => $this->performer,
            'caption'              => $this->caption,
            'title'                => $this->title,
        ]);
    }
}
