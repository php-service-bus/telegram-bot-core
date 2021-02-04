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

/**
 * Contains information about documents or other Telegram Passport elements shared with the bot by the user.
 *
 * @see https://core.telegram.org/bots/api#encryptedpassportelement
 *
 * @psalm-immutable
 */
final class EncryptedPassportElement
{
    /**
     * Element type.
     *
     * @var EncryptedPassportElementType
     */
    public $type;

    /**
     * Optional. Base64-encoded encrypted Telegram Passport element data provided by the user, available for
     * “personal_details”, “passport”, “driver_license”, “identity_card”, “internal_passport” and “address” types. Can
     * be decrypted and verified using the accompanying EncryptedCredentials.
     *
     * @psalm-readonly
     *
     * @see https://core.telegram.org/bots/api#encryptedcredentials
     *
     * @var string|null
     */
    public $data;

    /**
     * Optional. User's verified phone number, available only for “phone_number” type.
     *
     * @psalm-readonly
     *
     * @var string|null
     */
    public $phoneNumber;

    /**
     * Optional. User's verified email address, available only for “email” type.
     *
     * @psalm-readonly
     *
     * @var string|null
     */
    public $email;

    /**
     * Optional. Array of encrypted files with documents provided by the user, available for “utility_bill”,
     * “bank_statement”, “rental_agreement”, “passport_registration” and “temporary_registration” types. Files can be
     * decrypted and verified using the accompanying EncryptedCredentials.
     *
     * @psalm-readonly
     *
     * @see https://core.telegram.org/bots/api#encryptedcredentials
     *
     * @var PassportFile[]
     */
    public $files = [];

    /**
     * Optional. Encrypted file with the front side of the document, provided by the user. Available for “passport”,
     * “driver_license”, “identity_card” and “internal_passport”. The file can be decrypted and verified using the
     * accompanying EncryptedCredentials.
     *
     * @psalm-readonly
     *
     * @see https://core.telegram.org/bots/api#encryptedcredentials
     *
     * @var PassportFile|null
     */
    public $frontSide;

    /**
     * Optional. Encrypted file with the reverse side of the document, provided by the user. Available for
     * “driver_license” and “identity_card”. The file can be decrypted and verified using the accompanying
     * EncryptedCredentials.
     *
     * @psalm-readonly
     *
     * @see https://core.telegram.org/bots/api#encryptedcredentials
     *
     * @var PassportFile|null
     */
    public $reverseSide;

    /**
     * Optional. Encrypted file with the selfie of the user holding a document, provided by the user; available for
     * “passport”, “driver_license”, “identity_card” and “internal_passport”. The file can be decrypted and verified
     * using the accompanying EncryptedCredentials.
     *
     * @psalm-readonly
     *
     * @see https://core.telegram.org/bots/api#encryptedcredentials
     *
     * @var PassportFile|null
     */
    public $selfie;

    /**
     * Optional. Array of encrypted files with translated versions of documents provided by the user. Available if
     * requested for “passport”, “driver_license”, “identity_card”, “internal_passport”, “utility_bill”,
     * “bank_statement”, “rental_agreement”, “passport_registration” and “temporary_registration” types. Files can be
     * decrypted and verified using the accompanying EncryptedCredentials.
     *
     * @psalm-readonly
     *
     * @see https://core.telegram.org/bots/api#encryptedcredentials
     *
     * @var PassportFile[]
     */
    public $translation = [];

    /**
     * Base64-encoded element hash for using in PassportElementErrorUnspecified.
     *
     * @psalm-readonly
     *
     * @see https://core.telegram.org/bots/api#passportelementerrorunspecified
     *
     * @var string|null
     */
    public $hash;
}
