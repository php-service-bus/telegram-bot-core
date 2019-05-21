<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Type\Video;

use ServiceBus\TelegramBot\Api\Type\Photo\PhotoSize;

/**
 * Represents a video message (available in Telegram apps as of v.4.0).
 *
 * @see https://core.telegram.org/bots/api#videonote
 *
 * @property-read string         $fileId
 * @property-read int            $length
 * @property-read int            $duration
 * @property-read PhotoSize|null $thumb
 * @property-read int|null       $fileSize
 */
final class VideoNote
{
    /**
     * Unique identifier for this file.
     *
     * @var string
     */
    public $fileId;

    /**
     * Video width and height (diameter of the video message) as defined by sender.
     *
     * @var int
     */
    public $length;

    /**
     * Duration of the video in seconds as defined by sender.
     *
     * @var int
     */
    public $duration;

    /**
     * Optional. Video thumbnail.
     *
     * @var PhotoSize|null
     */
    public $thumb;

    /**
     * Optional. File size.
     *
     * @var int|null
     */
    public $fileSize;
}
