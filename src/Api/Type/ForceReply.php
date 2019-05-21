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

/**
 * Upon receiving a message with this object, Telegram clients will display a reply interface to the user (act as if
 * the user has selected the bot‘s message and tapped ’Reply'). This can be extremely useful if you want to create
 * user-friendly step-by-step interfaces without having to sacrifice privacy mode.
 *
 * @see https://core.telegram.org/bots/api#forcereply
 *
 * @property-read bool $forceReply
 * @property-read bool $selective
 */
final class ForceReply implements ReplayMarkup
{
    /**
     * Shows reply interface to the user, as if they manually selected the bot‘s message and tapped ’Reply'.
     *
     * @var bool
     */
    public $forceReply = false;

    /**
     * Optional. Use this parameter if you want to force reply from specific users only. Targets: 1) users that are.
     *
     * @mentioned in the text of the Message object; 2) if the bot's message is a reply (has reply_to_message_id),
     *            sender of the original message.
     *
     * @var bool
     */
    public $selective = false;
}
