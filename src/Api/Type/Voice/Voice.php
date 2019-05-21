<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Type\Voice;

/**
 * Represents a voice note.
 *
 * @see https://core.telegram.org/bots/api#voice
 *
 * @property-read string      $fileId
 * @property-read int         $duration
 * @property-read string|null $mimeType
 * @property-read int|null    $fileSize
 */
final class Voice
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
}
