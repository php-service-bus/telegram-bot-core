<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 0);

namespace ServiceBus\TelegramBot\Api\Type\Keyboard;

use ServiceBus\TelegramBot\Api\Type\ReplayMarkup;

/**
 * Represents a custom keyboard with reply options (see Introduction to bots for details and examples).
 *
 * @see https://core.telegram.org/bots/api#replykeyboardmarkup
 * @see https://core.telegram.org/bots#keyboards
 *
 * @psalm-immutable
 */
final class ReplyKeyboardMarkup implements ReplayMarkup
{
    /**
     * Array of button rows, each represented by an Array of KeyboardButton objects.
     *
     * @psalm-readonly
     *
     * @var KeyboardButton[][]
     */
    public $keyboard = [];

    /**
     * Optional. Requests clients to resize the keyboard vertically for optimal fit (e.g., make the keyboard smaller if
     * there are just two rows of buttons). Defaults to false, in which case the custom keyboard is always of the same
     * height as the app's standard keyboard.
     *
     * @psalm-readonly
     *
     * @var bool
     */
    public $resizeKeyboard = false;

    /**
     * Optional. Requests clients to hide the keyboard as soon as it's been used. The keyboard will still be available,
     * but clients will automatically display the usual letter-keyboard in the chat – the user can press a special
     * button in the input field to see the custom keyboard again. Defaults to false.
     *
     * @psalm-readonly
     *
     * @var bool
     */
    public $oneTimeKeyboard = false;

    /**
     * Optional. Use this parameter if you want to show the keyboard to specific users only. Targets: 1) users that are
     * mentioned in the text of the Message object; 2) if the bot's message is a reply (has reply_to_message_id),
     * sender of the original message.
     *
     * Example: A user requests to change the bot‘s language, bot replies to the request with a keyboard to select the
     * new language. Other users in the group don’t see the keyboard.
     *
     * @psalm-readonly
     *
     * @var bool
     */
    public $selective = false;

    public static function withButtons(bool $resizeKeyboard, bool $oneTimeKeyboard, KeyboardButton ...$buttons): self
    {
        return new self([$buttons], $resizeKeyboard, $oneTimeKeyboard);
    }

    /**
     * @param KeyboardButton[][] $keyboard
     */
    public function __construct(
        array $keyboard,
        bool $resizeKeyboard = false,
        bool $oneTimeKeyboard = false,
        bool $selective = false
    ) {
        $this->keyboard        = $keyboard;
        $this->resizeKeyboard  = $resizeKeyboard;
        $this->oneTimeKeyboard = $oneTimeKeyboard;
        $this->selective       = $selective;
    }
}
