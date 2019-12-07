<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

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
 * @psalm-readonly
 */
final class Document
{
    /**
     * Unique file identifier.
     *
     * @var string
     */
    public $fileId;

    /**
     * Optional. Document thumbnail as defined by sender.
     *
     * @var PhotoSize|null
     */
    public $thumb;

    /**
     * Optional. Original filename as defined by sender.
     *
     * @var string|null
     */
    public $fileName;

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
