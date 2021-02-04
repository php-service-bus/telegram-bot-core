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
use ServiceBus\TelegramBot\Api\Type\Message\InlineMessageId;
use ServiceBus\TelegramBot\Api\Type\User\User;

/**
 * Represents a result of an inline query that was chosen by the user and sent to their chat partner.
 *
 * @see  https://core.telegram.org/bots/api#choseninlineresult
 *
 * @psalm-immutable
 */
final class ChosenInlineResult
{
    /**
     * The unique identifier for the result that was chosen.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $resultId;

    /**
     * The user that chose the result.
     *
     * @psalm-readonly
     *
     * @var User
     */
    public $from;

    /**
     * Optional. Sender location, only for bots that require user location.
     *
     * @psalm-readonly
     *
     * @var Location|null
     */
    public $location;

    /**
     * Optional. Identifier of the sent inline message. Available only if there is an inline keyboard attached to the
     * message. Will be also received in callback queries and can be used to edit the message.
     *
     * @psalm-readonly
     *
     * @var InlineMessageId|null
     */
    public $inlineMessageId;

    /**
     * The query that was used to obtain the result.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $query;
}
