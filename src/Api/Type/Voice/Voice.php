<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
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
 * @psalm-immutable
 */
final class Voice
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
     * Duration of the audio in seconds as defined by sender.
     *
     * @psalm-readonly
     *
     * @var int
     */
    public $duration;

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
