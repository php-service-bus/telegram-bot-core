<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types=0);

namespace ServiceBus\TelegramBot\Api\Type\InputMedia;

use ServiceBus\HttpClient\InputFilePath;
use ServiceBus\TelegramBot\Api\Type\ParseMode;

/**
 * Represents a video to be sent.
 *
 * @see https://core.telegram.org/bots/api#inputmediavideo
 *
 * @psalm-immutable
 */
final class InputMediaVideo implements InputMedia
{
    /**
     * Type of the result, must be video.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $type = 'video';

    /**
     * File to send. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL
     * for Telegram to get a file from the Internet, or pass “attach://<file_attach_name>” to upload a new one using
     * multipart/form-data under <file_attach_name> name.
     *
     * @psalm-readonly
     *
     * @see https://core.telegram.org/bots/api#sending-files
     *
     * @var InputFilePath|string
     */
    public $media;

    /**
     * Optional. Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported
     * server-side. The thumbnail should be in JPEG format and less than 200 kB in size. A thumbnail‘s width and height
     * should not exceed 320. Ignored if the file is not uploaded using multipart/form-data. Thumbnails can’t be reused
     * and can be only uploaded as a new file, so you can pass “attach://<file_attach_name>” if the thumbnail was
     * uploaded using multipart/form-data under <file_attach_name>.
     *
     * @psalm-readonly
     *
     * @see https://core.telegram.org/bots/api#sending-files
     *
     * @var InputFilePath|string
     */
    public $thumb;

    /**
     * Optional. Caption of the video to be sent, 0-1024 characters.
     *
     * @psalm-readonly
     *
     * @var string|null
     */
    public $caption;

    /**
     * Optional. Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs
     * in the media caption.
     *
     * @psalm-readonly
     *
     * @var ParseMode|null
     */
    public $parseMode;

    /**
     * Optional. Video width.
     *
     * @psalm-readonly
     *
     * @var int|null
     */
    public $width;

    /**
     * Optional. Video height.
     *
     * @psalm-readonly
     *
     * @var int|null
     */
    public $height;

    /**
     * Optional. Video duration.
     *
     * @psalm-readonly
     *
     * @var int|null
     */
    public $duration;

    /**
     * Optional. Pass True, if the uploaded video is suitable for streaming.
     *
     * @psalm-readonly
     *
     * @var bool
     */
    public $supportsStreaming = false;
}
