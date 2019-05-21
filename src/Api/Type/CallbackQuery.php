<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Type;

use ServiceBus\TelegramBot\Api\Type\Message\InlineMessageId;
use ServiceBus\TelegramBot\Api\Type\Message\Message;
use ServiceBus\TelegramBot\Api\Type\User\User;

/**
 * This object represents an incoming callback query from a callback button in an inline keyboard. If the button that
 * originated the query was attached to a message sent by the bot, the field message will be present. If the button was
 * attached to a message sent via the bot (in inline mode), the field inline_message_id will be present. Exactly one of
 * the fields data or game_short_name will be present.
 *
 * @see https://core.telegram.org/bots/api#callbackquery
 * @see https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating
 *
 * @property-read string               $id
 * @property-read User                 $from
 * @property-read Message|null         $message
 * @property-read InlineMessageId|null $inlineMessageId
 * @property-read string               $chatInstance
 * @property-read string|null          $data
 * @property-read string|null          $gameShortName
 */
final class CallbackQuery
{
    /**
     * Unique identifier for this query.
     *
     * @var string
     */
    public $id;

    /**
     * Sender.
     *
     * @var User
     */
    public $from;

    /**
     * Optional. Message with the callback button that originated the query. Note that message content and message date
     * will not be available if the message is too old.
     *
     * @var Message|null
     */
    public $message;

    /**
     * Optional. Identifier of the message sent via the bot in inline mode, that originated the query.
     *
     * @var InlineMessageId|null
     */
    public $inlineMessageId;

    /**
     * Global identifier, uniquely corresponding to the chat to which the message with the callback button was sent.
     * Useful for high scores in games.
     *
     * @see https://core.telegram.org/bots/api#games
     *
     * @var string
     */
    public $chatInstance;

    /**
     * Optional. Data associated with the callback button. Be aware that a bad client can send arbitrary data in this
     * field.
     *
     * @var string|null
     */
    public $data;

    /**
     * Optional. Short name of a Game to be returned, serves as the unique identifier for the game.
     *
     * @see https://core.telegram.org/bots/api#games
     *
     * @var string|null
     */
    public $gameShortName;
}
