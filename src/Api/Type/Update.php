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

use ServiceBus\TelegramBot\Api\Type\InlineQuery\ChosenInlineResult;
use ServiceBus\TelegramBot\Api\Type\InlineQuery\InlineQuery;
use ServiceBus\TelegramBot\Api\Type\Message\Message;
use ServiceBus\TelegramBot\Api\Type\Order\PreCheckoutQuery;
use ServiceBus\TelegramBot\Api\Type\Poll\Poll;
use ServiceBus\TelegramBot\Api\Type\Shipping\ShippingQuery;

/**
 * This object represents an incoming update.
 * At most one of the optional parameters can be present in any given update.
 *
 * @see https://core.telegram.org/bots/api#update
 *
 * @property-read int                     $updateId
 * @property-read Message|null            $message
 * @property-read Message|null            $editedMessage
 * @property-read Message|null            $channelPost
 * @property-read Message|null            $editedChannelPost
 * @property-read InlineQuery|null        $inlineQuery
 * @property-read ChosenInlineResult|null $chosenInlineResult
 * @property-read CallbackQuery|null      $callbackQuery
 * @property-read ShippingQuery|null      $shippingQuery
 * @property-read PreCheckoutQuery|null   $preCheckoutQuery
 * @property-read Poll|null               $poll
 */
final class Update
{
    /**
     * The update‘s unique identifier. Update identifiers start from a certain positive number and increase
     * sequentially. This ID becomes especially handy if you’re using Webhooks, since it allows you to ignore repeated
     * updates or to restore the correct update sequence, should they get out of order. If there are no new updates for
     * at least a week, then identifier of the next update will be chosen randomly instead of sequentially.
     *
     * @var int
     */
    public $updateId;

    /**
     * Optional. New incoming message of any kind — text, photo, sticker, etc.
     *
     * @var Message|null
     */
    public $message;

    /**
     * Optional. New version of a message that is known to the bot and was edited.
     *
     * @var Message|null
     */
    public $editedMessage;

    /**
     * Optional. New incoming channel post of any kind — text, photo, sticker, etc.
     *
     * @var Message|null
     */
    public $channelPost;

    /**
     * Optional. New version of a channel post that is known to the bot and was edited.
     *
     * @var Message|null
     */
    public $editedChannelPost;

    /**
     * Optional. New incoming inline query.
     *
     * @var InlineQuery|null
     */
    public $inlineQuery;

    /**
     * Optional. The result of an inline query that was chosen by a user and sent to their chat partner. Please see our
     * documentation on the feedback collecting for details on how to enable these updates for your bot.
     *
     * @var ChosenInlineResult|null
     */
    public $chosenInlineResult;

    /**
     * Optional. New incoming callback query.
     *
     * @var CallbackQuery|null
     */
    public $callbackQuery;

    /**
     * Optional. New incoming shipping query. Only for invoices with flexible price
     * pre_checkout_query    PreCheckoutQuery    Optional. New incoming pre-checkout query. Contains full information
     * about checkout poll    Poll    Optional. New poll state. Bots receive only updates about polls, which are sent
     * or stopped by the bot.
     *
     * @var ShippingQuery|null
     */
    public $shippingQuery;

    /**
     * Optional. New incoming pre-checkout query. Contains full information about checkout.
     *
     * @var PreCheckoutQuery|null
     */
    public $preCheckoutQuery;

    /**
     * Optional. New poll state. Bots receive only updates about polls, which are sent or stopped by the bot.
     *
     * @var Poll|null
     */
    public $poll;
}
