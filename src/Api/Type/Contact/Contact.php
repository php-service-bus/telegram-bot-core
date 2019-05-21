<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Type\Contact;

use ServiceBus\TelegramBot\Api\Type\User\UserId;

/**
 * Represents a phone contact.
 *
 * @see https://core.telegram.org/bots/api#contact
 *
 * @property-read string      $phoneNumber
 * @property-read string      $firstName
 * @property-read string|null $lastName
 * @property-read UserId|null $userId
 * @property-read string|null $vcard
 */
final class Contact
{
    /**
     * Contact's phone number.
     *
     * @var string
     */
    public $phoneNumber;

    /**
     * Contact's first name.
     *
     * @var string
     */
    public $firstName;

    /**
     * Optional. Contact's last name.
     *
     * @var string|null
     */
    public $lastName;

    /**
     * Optional. Contact's user identifier in Telegram.
     *
     * @var UserId|null
     */
    public $userId;

    /**
     * Optional. Additional data about the contact in the form of a vCard.
     *
     * @see https://en.wikipedia.org/wiki/VCard
     *
     * @var string|null
     */
    public $vcard;
}
