<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 0);

namespace ServiceBus\TelegramBot\Api\Type\Passport;

use ServiceBus\TelegramBot\Api\Type\Common\UnixTime;

/**
 * Represents a file uploaded to Telegram Passport. Currently all Telegram Passport files are in JPEG format when
 * decrypted and don't exceed 10MB.
 *
 * @see https://core.telegram.org/bots/api#passportfile
 *
 * @psalm-immutable
 */
final class PassportFile
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
     * File size.
     *
     * @psalm-readonly
     *
     * @var int
     */
    public $fileSize;

    /**
     * Unix time when the file was uploaded.
     *
     * @psalm-readonly
     *
     * @var UnixTime
     */
    public $fileDate;
}
