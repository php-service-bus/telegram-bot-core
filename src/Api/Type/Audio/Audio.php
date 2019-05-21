<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Type\Audio;

use ServiceBus\TelegramBot\Api\Type\Photo\PhotoSize;

/**
 * Represents an audio file to be treated as music by the Telegram clients.
 *
 * @see https://core.telegram.org/bots/api#audio
 *
 * @property-read string         $fileId
 * @property-read int            $duration
 * @property-read string|null    $performer
 * @property-read string|null    $title
 * @property-read string|null    $mimeType
 * @property-read int|null       $fileSize
 * @property-read PhotoSize|null $thumb
 */
final class Audio
{
    /**
     * Unique identifier for this file.
     *
     * @var string
     */
    public $fileId;

    /**
     * Duration of the audio in seconds as defined by sender.
     *
     * @var int
     */
    public $duration;

    /**
     * Optional. Performer of the audio as defined by sender or by audio tags.
     *
     * @var string|null
     */
    public $performer;

    /**
     * Optional. Title of the audio as defined by sender or by audio tags.
     *
     * @var string|null
     */
    public $title;

    /**
     * Optional. MIME type of the file as defined by sender.
     *
     * @var string|null
     */
    public $mimeType;

    /**
     * Optional. File size.
     *
     * @var int|null
     */
    public $fileSize;

    /**
     * Optional. Thumbnail of the album cover to which the music file belongs.
     *
     * @var PhotoSize|null
     */
    public $thumb;
}
