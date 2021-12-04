<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types=0);

namespace ServiceBus\TelegramBot\Api\Type\Animation;

use ServiceBus\TelegramBot\Api\Type\Photo\PhotoSize;

/**
 * Represents an animation file (GIF or H.264/MPEG-4 AVC video without sound).
 *
 * @see https://core.telegram.org/bots/api#animation
 *
 * @psalm-immutable
 */
final class Animation
{
    /**
     * Unique file identifier.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $fileId;

    /**
     * Video width as defined by sender.
     *
     * @psalm-readonly
     *
     * @var int
     */
    public $width;

    /**
     * Video height as defined by sender.
     *
     * @psalm-readonly
     *
     * @var int
     */
    public $height;

    /**
     * Duration of the video in seconds as defined by sender.
     *
     * @psalm-readonly
     *
     * @var int
     */
    public $duration;

    /**
     * Optional. Animation thumbnail as defined by sender.
     *
     * @psalm-readonly
     *
     * @var PhotoSize|null
     */
    public $thumb;

    /**
     * Optional. Original animation filename as defined by sender.
     *
     * @psalm-readonly
     *
     * @var string|null
     */
    public $fileName;

    /**
     * Optional. MIME type of the file as defined by sender.
     *
     * @psalm-readonly
     *
     * @var string|null
     */
    public $mimeType;

    /**
     * Optional. File size.
     *
     * @psalm-readonly
     *
     * @var int|null
     */
    public $fileSize;
}
