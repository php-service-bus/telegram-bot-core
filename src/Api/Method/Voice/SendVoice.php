<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types=0);

namespace ServiceBus\TelegramBot\Api\Method\Voice;

use ServiceBus\HttpClient\InputFilePath;
use ServiceBus\TelegramBot\Api\Method\SendEntity;
use ServiceBus\TelegramBot\Api\Type\Chat\ChatId;
use ServiceBus\TelegramBot\Api\Type\ParseMode;

/**
 * Send audio files, if you want Telegram clients to display the file as a playable voice message.
 *
 * @see https://core.telegram.org/bots/api#sendvoice
 */
final class SendVoice extends SendEntity
{
    /**
     * Audio file to send. Pass a file_id as String to send a file that exists on the Telegram servers (recommended),
     * pass an HTTP URL as a String for Telegram to get a file from the Internet, or upload a new one using
     * multipart/form-data.
     *
     * @var InputFilePath|string
     */
    private $voice;

    /**
     * Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in your
     * bot's message.
     *
     * @var ParseMode|null
     */
    private $parseMode;

    /**
     * Voice message caption, 0-1024 characters.
     *
     * @var string|null
     */
    private $caption;

    /**
     * Duration of the voice message in seconds.
     *
     * @var int|null
     */
    private $duration;

    public static function uploadFile(ChatId $chatId, InputFilePath $file, ?string $caption): self
    {
        $self = new self($chatId);

        $self->voice   = $file;
        $self->caption = $caption;

        return $self;
    }

    /**
     * @throws \InvalidArgumentException
     */
    public static function withUploadedFile(ChatId $chatId, string $fileId, ?string $caption): self
    {
        if ($fileId === '')
        {
            throw new \InvalidArgumentException('Voice file_id to send must be specified');
        }

        $self = new self($chatId);

        $self->voice   = $fileId;
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

    public function methodName(): string
    {
        return 'sendVoice';
    }

    public function requestData(): array
    {
        return \array_filter([
            'chat_id'              => $this->chatId(),
            'disable_notification' => $this->notificationStatus(),
            'reply_to_message_id'  => $this->replyToMessage(),
            'parse_mode'           => $this->parseMode?->toString(),
            'reply_markup'         => $this->replyMarkup(),
            'voice'                => $this->voice,
            'duration'             => $this->duration,
            'caption'              => $this->caption,
        ]);
    }
}
