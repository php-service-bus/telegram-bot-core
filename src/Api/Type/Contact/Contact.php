<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
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
 * @psalm-immutable
 */
final class Contact
{
    /**
     * Contact's phone number.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $phoneNumber;

    /**
     * Contact's first name.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $firstName;

    /**
     * Optional. Contact's last name.
     *
     * @psalm-readonly
     *
     * @var string|null
     */
    public $lastName;

    /**
     * Optional. Contact's user identifier in Telegram.
     *
     * @psalm-readonly
     *
     * @var UserId|null
     */
    public $userId;

    /**
     * Optional. Additional data about the contact in the form of a vCard.
     *
     * @psalm-readonly
     *
     * @see https://en.wikipedia.org/wiki/VCard
     *
     * @var string|null
     */
    public $vcard;
}
