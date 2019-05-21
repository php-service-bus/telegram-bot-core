<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Type\Sticker;

use ServiceBus\TelegramBot\Api\Type\MaskPosition;
use ServiceBus\TelegramBot\Api\Type\Photo\PhotoSize;

/**
 * Represents a sticker.
 *
 * @see https://core.telegram.org/bots/api#sticker
 *
 * @property-read string            $fileId
 * @property-read int               $width
 * @property-read int               $height
 * @property-read PhotoSize|null    $thumb
 * @property-read string|null       $emoji
 * @property-read string|null       $setName
 * @property-read MaskPosition|null $maskPosition
 * @property-read int|null          $fileSize
 */
final class Sticker
{
    /**
     * Unique identifier for this file.
     *
     * @var string
     */
    public $fileId;

    /**
     * Sticker width.
     *
     * @var int
     */
    public $width;

    /**
     * Sticker height.
     *
     * @var int
     */
    public $height;

    /**
     * Optional. Sticker thumbnail in the .webp or .jpg format.
     *
     * @var PhotoSize|null
     */
    public $thumb;

    /**
     * Optional. Emoji associated with the sticker.
     *
     * @var string|null
     */
    public $emoji;

    /**
     * Optional. Name of the sticker set to which the sticker belongs.
     *
     * @var string|null
     */
    public $setName;

    /**
     * Optional. For mask stickers, the position where the mask should be placed.
     *
     * @var MaskPosition|null
     */
    public $maskPosition;

    /**
     * Optional. File size.
     *
     * @var int|null
     */
    public $fileSize;
}
