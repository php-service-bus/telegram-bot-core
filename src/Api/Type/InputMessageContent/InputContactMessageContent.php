<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Type\InputMessageContent;

/**
 * Represents the content of a contact message to be sent as the result of an inline query.
 *
 * @see https://core.telegram.org/bots/api#inputcontactmessagecontent
 *
 * @property-read string      $phoneNumber
 * @property-read string      $firstName
 * @property-read string|null $lastName
 * @property-read string|null $vcard
 */
final class InputContactMessageContent implements InputMessageContent
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
     * Optional. Additional data about the contact in the form of a vCard, 0-2048 bytes.
     *
     * @see https://en.wikipedia.org/wiki/VCard
     *
     * @var string|null
     */
    public $vcard;
}
