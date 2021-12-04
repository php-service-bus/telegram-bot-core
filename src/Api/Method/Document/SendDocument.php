<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types=0);

namespace ServiceBus\TelegramBot\Api\Method\Document;

use ServiceBus\HttpClient\InputFilePath;
use ServiceBus\TelegramBot\Api\Method\SendEntity;
use ServiceBus\TelegramBot\Api\Type\Chat\ChatId;
use ServiceBus\TelegramBot\Api\Type\ParseMode;

/**
 * Send general files.
 *
 * @see https://core.telegram.org/bots/api#senddocument
 */
final class SendDocument extends SendEntity
{
    /**
     * File to send. Pass a file_id as String to send a file that exists on the Telegram servers (recommended), pass an
     * HTTP URL as a String for Telegram to get a file from the Internet, or upload a new one using multipart/form-data.
     *
     * @var InputFilePath|string
     */
    private $document;

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

    /**
     * Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in your
     * bot's message.
     *
     * @var ParseMode|null
     */
    private $parseMode;

    /**
     * Document caption (may also be used when resending documents by file_id), 0-1024 characters.
     *
     * @var string|null
     */
    private $caption;

    public static function uploadFile(ChatId $chatId, InputFilePath $file, ?string $caption = null): self
    {
        $self = new self($chatId);

        $self->document = $file;
        $self->caption  = $caption;

        return $self;
    }

    /**
     * @throws \InvalidArgumentException
     */
    public static function withUploadedFile(ChatId $chatId, string $fileId, ?string $caption = null): self
    {
        if ($fileId === '')
        {
            throw new \InvalidArgumentException('Document file_id to send must be specified');
        }

        $self = new self($chatId);

        $self->document = $fileId;
        $self->caption  = $caption;

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

    public function methodName(): string
    {
        return 'sendDocument';
    }

    public function requestData(): array
    {
        return \array_filter(
            [
                'chat_id'              => $this->chatId(),
                'disable_notification' => $this->notificationStatus(),
                'reply_to_message_id'  => $this->replyToMessage(),
                'parse_mode'           => $this->parseMode?->toString(),
                'reply_markup'         => $this->replyMarkup(),
                'document'             => $this->document,
                'caption'              => $this->caption,
            ]
        );
    }
}
