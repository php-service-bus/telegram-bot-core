<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Type\Photo;

/**
 * Represents one size of a photo or a file/sticker thumbnail.
 *
 * @see https://core.telegram.org/bots/api#document
 * @see https://core.telegram.org/bots/api#sticker
 *
 * @property-read string   $fileId
 * @property-read int      $width
 * @property-read int      $height
 * @property-read int|null $fileSize
 */
final class PhotoSize
{
    /**
     * Unique identifier for this file.
     *
     * @var string
     */
    public $fileId;

    /**
     * Photo width.
     *
     * @var int
     */
    public $width;

    /**
     * Photo height.
     *
     * @var int
     */
    public $height;

    /**
     * Optional. File size.
     *
     * @var int|null
     */
    public $fileSize;
}
