<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 0);

namespace ServiceBus\TelegramBot\Api\Type\Audio;

use ServiceBus\TelegramBot\Api\Type\Photo\PhotoSize;

/**
 * Represents an audio file to be treated as music by the Telegram clients.
 *
 * @see https://core.telegram.org/bots/api#audio
 *
 * @psalm-immutable
 */
final class Audio
{
    /**
     * Unique identifier for this file
     *
     * @psalm-readonly .
     *
     * @var string
     */
    public $fileId;

    /**
     * Duration of the audio in seconds as defined by sender.
     *
     * @psalm-readonly
     *
     * @var int
     */
    public $duration;

    /**
     * Optional. Performer of the audio as defined by sender or by audio tags.
     *
     * @psalm-readonly
     *
     * @var string|null
     */
    public $performer;

    /**
     * Optional. Title of the audio as defined by sender or by audio tags.
     *
     * @psalm-readonly
     *
     * @var string|null
     */
    public $title;

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

    /**
     * Optional. Thumbnail of the album cover to which the music file belongs.
     *
     * @psalm-readonly
     *
     * @var PhotoSize|null
     */
    public $thumb;
}
