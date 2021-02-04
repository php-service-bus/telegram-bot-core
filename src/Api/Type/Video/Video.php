<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Type\Video;

use ServiceBus\TelegramBot\Api\Type\Photo\PhotoSize;

/**
 * Represents a video file.
 *
 * @see https://core.telegram.org/bots/api#video
 *
 * @psalm-immutable
 */
final class Video
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
     * Optional. Video thumbnail.
     *
     * @psalm-readonly
     *
     * @var PhotoSize|null
     */
    public $thumb;

    /**
     * Optional. Mime type of a file as defined by sender.
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
