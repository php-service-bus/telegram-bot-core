<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 0);

namespace ServiceBus\TelegramBot\Api\Type\InlineQuery;

use ServiceBus\TelegramBot\Api\Type\Location\Location;
use ServiceBus\TelegramBot\Api\Type\User\User;

/**
 * Represents an incoming inline query. When the user sends an empty query, your bot could return some default or
 * trending results.
 *
 * @see https://core.telegram.org/bots/api#inlinequery
 *
 * @psalm-immutable
 */
final class InlineQuery
{
    /**
     * Unique identifier for this query.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $id;

    /**
     * Sender.
     *
     * @psalm-readonly
     *
     * @var User
     */
    public $from;

    /**
     * Optional. Sender location, only for bots that request user location.
     *
     * @psalm-readonly
     *
     * @var Location|null
     */
    public $location;

    /**
     * Text of the query (up to 512 characters).
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $query;

    /**
     * Offset of the results to be returned, can be controlled by the bot.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $offset;
}
