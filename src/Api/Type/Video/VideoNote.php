<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 0);

namespace ServiceBus\TelegramBot\Api\Type\Video;

use ServiceBus\TelegramBot\Api\Type\Photo\PhotoSize;

/**
 * Represents a video message (available in Telegram apps as of v.4.0).
 *
 * @see https://core.telegram.org/bots/api#videonote
 *
 * @psalm-immutable
 */
final class VideoNote
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
     * Video width and height (diameter of the video message) as defined by sender.
     *
     * @psalm-readonly
     *
     * @var int
     */
    public $length;

    /**
     * Duration of the video in seconds as defined by sender.
     *
     * @psalm-readonly
     *
     * @var int
     */
    public $duration;

    /**
     * Optional. Video thumbnail.
     *
     * @psalm-readonly
     *
     * @var PhotoSize|null
     */
    public $thumb;

    /**
     * Optional. File size.
     *
     * @psalm-readonly
     *
     * @var int|null
     */
    public $fileSize;
}
