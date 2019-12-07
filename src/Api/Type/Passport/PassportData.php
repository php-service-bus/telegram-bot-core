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

/**
 * Contains information about Telegram Passport data shared with the bot by the user.
 *
 * @see https://core.telegram.org/bots/api#passportdata
 *
 * @psalm-readonly
 */
final class PassportData
{
    /**
     * Array with information about documents and other Telegram Passport elements that was shared with the bot.
     *
     * @var EncryptedPassportElement[]
     */
    public $data = [];

    /**
     * Encrypted credentials required to decrypt the data.
     *
     * @var EncryptedCredentials
     */
    public $credentials;
}
