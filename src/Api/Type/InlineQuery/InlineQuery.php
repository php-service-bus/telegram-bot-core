<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Type\InlineQuery;

use ServiceBus\TelegramBot\Api\Type\Location\Location;
use ServiceBus\TelegramBot\Api\Type\User\User;

/**
 * Represents an incoming inline query. When the user sends an empty query, your bot could return some default or
 * trending results.
 *
 * @see https://core.telegram.org/bots/api#inlinequery
 *
 * @property-read string        $id
 * @property-read User          $from
 * @property-read Location|null $location
 * @property-read string        $query
 * @property-read string        $offset
 */
final class InlineQuery
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
     * Optional. Sender location, only for bots that request user location.
     *
     * @var Location|null
     */
    public $location;

    /**
     * Text of the query (up to 512 characters).
     *
     * @var string
     */
    public $query;

    /**
     * Offset of the results to be returned, can be controlled by the bot.
     *
     * @var string
     */
    public $offset;
}
