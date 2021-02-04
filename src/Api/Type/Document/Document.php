<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 0);

namespace ServiceBus\TelegramBot\Api\Type\Document;

use ServiceBus\TelegramBot\Api\Type\Photo\PhotoSize;

/**
 * Represents a general file (as opposed to photos, voice messages and audio files).
 *
 * @see https://core.telegram.org/bots/api#document
 * @see https://core.telegram.org/bots/api#photosize
 * @see https://core.telegram.org/bots/api#voice
 * @see https://core.telegram.org/bots/api#audio
 *
 * @psalm-immutable
 */
final class Document
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
     * Optional. Document thumbnail as defined by sender.
     *
     * @psalm-readonly
     *
     * @var PhotoSize|null
     */
    public $thumb;

    /**
     * Optional. Original filename as defined by sender.
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
