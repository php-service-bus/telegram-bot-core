<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Type\Passport;

use ServiceBus\TelegramBot\Api\Type\Enum;

/**
 * Element type.
 */
final class EncryptedPassportElementType implements Enum
{
    private const PERSONAL_DETAILS       = 'personal_details';

    private const PASSPORT               = 'passport';

    private const DRIVER_LICENSE         = 'driver_license';

    private const IDENTITY_CARD          = 'identity_card';

    private const INTERNAL_PASSWORD      = 'internal_passport';

    private const ADDRESS                = 'address';

    private const UTILITY_BILL           = 'utility_bill';

    private const BANK_STATEMENT         = 'bank_statement';

    private const RENTAL_AGREEMENT       = 'rental_agreement';

    private const PASSWORD_REGISTRATION  = 'passport_registration';

    private const TEMPORARY_REGISTRATION = 'temporary_registration';

    private const PHONE_NUMBER           = 'phone_number';

    private const EMAIL                  = 'email';

    private const LIST                   = [
        self::PERSONAL_DETAILS,
        self::PASSPORT,
        self::DRIVER_LICENSE,
        self::IDENTITY_CARD,
        self::INTERNAL_PASSWORD,
        self::ADDRESS,
        self::UTILITY_BILL,
        self::BANK_STATEMENT,
        self::RENTAL_AGREEMENT,
        self::PASSWORD_REGISTRATION,
        self::TEMPORARY_REGISTRATION,
        self::PHONE_NUMBER,
        self::EMAIL,
    ];

    /**
     * @var string
     */
    private $value;

    /**
     * @psalm-suppress MoreSpecificReturnType
     */
    public static function create(string $value): static
    {
        if (\in_array($value, self::LIST, true) === false)
        {
            throw new \InvalidArgumentException(\sprintf('Incorrect passport element type: %s', $value));
        }

        return new self($value);
    }

    public function toString(): string
    {
        return $this->value;
    }

    private function __construct(string $value)
    {
        $this->value = $value;
    }
}
