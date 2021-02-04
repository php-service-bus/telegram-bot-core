<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 0);

namespace ServiceBus\TelegramBot\Api\Type\Sticker;

use ServiceBus\TelegramBot\Api\Type\MaskPosition;
use ServiceBus\TelegramBot\Api\Type\Photo\PhotoSize;

/**
 * Represents a sticker.
 *
 * @see https://core.telegram.org/bots/api#sticker
 *
 * @psalm-immutable
 */
final class Sticker
{
    /**
     * Unique identifier for this file.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $fileId;

    /**
     * Sticker width.
     *
     * @psalm-readonly
     *
     * @var int
     */
    public $width;

    /**
     * Sticker height.
     *
     * @psalm-readonly
     *
     * @var int
     */
    public $height;

    /**
     * Optional. Sticker thumbnail in the .webp or .jpg format.
     *
     * @psalm-readonly
     *
     * @var PhotoSize|null
     */
    public $thumb;

    /**
     * Optional. Emoji associated with the sticker.
     *
     * @psalm-readonly
     *
     * @var string|null
     */
    public $emoji;

    /**
     * Optional. Name of the sticker set to which the sticker belongs.
     *
     * @psalm-readonly
     *
     * @var string|null
     */
    public $setName;

    /**
     * Optional. For mask stickers, the position where the mask should be placed.
     *
     * @psalm-readonly
     *
     * @var MaskPosition|null
     */
    public $maskPosition;

    /**
     * Optional. File size.
     *
     * @psalm-readonly
     *
     * @var int|null
     */
    public $fileSize;
}
