<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
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
 * @psalm-immutable
 */
final class PhotoSize
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
     * Photo width.
     *
     * @psalm-readonly
     *
     * @var int
     */
    public $width;

    /**
     * Photo height.
     *
     * @psalm-readonly
     *
     * @var int
     */
    public $height;

    /**
     * Optional. File size.
     *
     * @psalm-readonly
     *
     * @var int|null
     */
    public $fileSize;
}
