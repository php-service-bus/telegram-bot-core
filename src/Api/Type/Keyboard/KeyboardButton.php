<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Type\Keyboard;

/**
 * Represents one button of the reply keyboard. For simple text buttons String can be used instead of this object to
 * specify text of the button. Optional fields are mutually exclusive.
 *
 * @see https://core.telegram.org/bots/api#keyboardbutton
 *
 * @psalm-readonly
 */
final class KeyboardButton
{
    /**
     * Text of the button. If none of the optional fields are used, it will be sent as a message when the button is
     * pressed.
     *
     * @var string
     */
    public $text;

    /**
     * Optional. If True, the user's phone number will be sent as a contact when the button is pressed. Available in
     * private chats only.
     *
     * @var bool
     */
    public $requestContact = false;

    /**
     * Optional. If True, the user's current location will be sent when the button is pressed. Available in private
     * chats only.
     *
     * @var bool
     */
    public $requestLocation = false;
}
