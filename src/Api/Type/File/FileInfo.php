<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 0);

namespace ServiceBus\TelegramBot\Api\Type\File;

/**
 * Represents a file ready to be downloaded. The file can be downloaded via the link
 * https://api.telegram.org/file/bot<token>/<file_path>. It is guaranteed that the link will be valid for at least 1
 * hour. When the link expires, a new one can be requested by calling getFile.
 *
 * @see https://core.telegram.org/bots/api#file
 * @see https://core.telegram.org/bots/api#getfile
 *
 * @psalm-immutable
 */
final class FileInfo
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
     * Optional. File size, if known.
     *
     * @psalm-readonly
     *
     * @var int|null
     */
    public $fileSize;

    /**
     * Optional. File path. Use https://api.telegram.org/file/bot<token>/<file_path> to get the file.
     *
     * @psalm-readonly
     *
     * @var string|null
     */
    public $filePath;
}
