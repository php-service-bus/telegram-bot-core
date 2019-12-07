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

use ServiceBus\TelegramBot\Api\Type\Location\Location;

/**
 * Represents the content of a location message to be sent as the result of an inline query.
 *
 * @see https://core.telegram.org/bots/api#inputlocationmessagecontent
 *
 * @psalm-readonly
 */
final class InputLocationMessageContent implements InputMessageContent
{
    /**
     * Coordinates.
     *
     * @var Location
     */
    public $coordinates;

    /**
     * Optional. Period in seconds for which the location can be updated, should be between 60 and 86400.
     *
     * @var int|null
     */
    public $livePeriod;
}
