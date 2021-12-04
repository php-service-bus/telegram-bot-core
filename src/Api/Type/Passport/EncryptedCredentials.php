<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types=0);

namespace ServiceBus\TelegramBot\Api\Type\Passport;

/**
 * Contains data required for decrypting and authenticating EncryptedPassportElement. See the Telegram Passport
 * Documentation for a complete description of the data decryption and authentication processes.
 *
 * @see https://core.telegram.org/bots/api#encryptedcredentials
 * @see https://core.telegram.org/bots/api#encryptedpassportelement
 * @see https://core.telegram.org/passport#receiving-information
 *
 * @psalm-immutable
 */
final class EncryptedCredentials
{
    /**
     * Base64-encoded encrypted JSON-serialized data with unique user's payload, data hashes and secrets required for
     * EncryptedPassportElement decryption and authentication.
     *
     * @psalm-readonly
     *
     * @see https://core.telegram.org/bots/api#encryptedpassportelement
     *
     * @var string
     */
    public $data;

    /**
     * Base64-encoded data hash for data authentication.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $hash;

    /**
     * Base64-encoded secret, encrypted with the bot's public RSA key, required for data decryption.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $secret;
}
