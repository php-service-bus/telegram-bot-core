<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 0);

namespace ServiceBus\TelegramBot\Api\Type\InputMessageContent;

/**
 * Represents the content of a contact message to be sent as the result of an inline query.
 *
 * @see https://core.telegram.org/bots/api#inputcontactmessagecontent
 *
 * @psalm-immutable
 */
final class InputContactMessageContent implements InputMessageContent
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
     * Optional. Additional data about the contact in the form of a vCard, 0-2048 bytes.
     *
     * @psalm-readonly
     *
     * @see https://en.wikipedia.org/wiki/VCard
     *
     * @var string|null
     */
    public $vcard;
}
