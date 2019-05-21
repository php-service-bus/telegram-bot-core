<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Type\Passport;

use ServiceBus\TelegramBot\Api\Type\Common\UnixTime;

/**
 * Represents a file uploaded to Telegram Passport. Currently all Telegram Passport files are in JPEG format when
 * decrypted and don't exceed 10MB.
 *
 * @see https://core.telegram.org/bots/api#passportfile
 *
 * @property-read string   $fileId
 * @property-read int      $fileSize
 * @property-read UnixTime $fileDate
 */
final class PassportFile
{
    /**
     * Unique identifier for this file.
     *
     * @var string
     */
    public $fileId;

    /**
     * File size.
     *
     * @var int
     */
    public $fileSize;

    /**
     * Unix time when the file was uploaded.
     *
     * @var UnixTime
     */
    public $fileDate;
}
