<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Type\InputMedia;

use ServiceBus\HttpClient\InputFilePath;
use ServiceBus\TelegramBot\Api\Type\ParseMode;

/**
 * Represents a photo to be sent.
 *
 * @see https://core.telegram.org/bots/api#inputmediaphoto
 *
 * @property-read string           $type
 * @property-read InputFilePath|string $media
 * @property-read string|null      $caption
 * @property-read ParseMode|null   $parseMode
 */
final class InputMediaPhoto implements InputMedia
{
    /**
     * Type of the result, must be photo.
     *
     * @var string
     */
    public $type = 'photo';

    /**
     * File to send. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL
     * for Telegram to get a file from the Internet, or pass “attach://<file_attach_name>” to upload a new one using
     * multipart/form-data under <file_attach_name> name.
     *
     * @var InputFilePath|string
     */
    public $media;

    /**
     * Optional. Caption of the photo to be sent, 0-1024 characters.
     *
     * @var string|null
     */
    public $caption;

    /**
     * Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in the
     * media caption.
     *
     * @var ParseMode|null
     */
    public $parseMode;
}
