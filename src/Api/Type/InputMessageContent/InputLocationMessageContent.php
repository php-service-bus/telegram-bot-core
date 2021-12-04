<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types=0);

namespace ServiceBus\TelegramBot\Api\Type\InputMessageContent;

use ServiceBus\TelegramBot\Api\Type\Location\Location;

/**
 * Represents the content of a location message to be sent as the result of an inline query.
 *
 * @see https://core.telegram.org/bots/api#inputlocationmessagecontent
 *
 * @psalm-immutable
 */
final class InputLocationMessageContent implements InputMessageContent
{
    /**
     * Coordinates.
     *
     * @psalm-readonly
     *
     * @var Location
     */
    public $coordinates;

    /**
     * Optional. Period in seconds for which the location can be updated, should be between 60 and 86400.
     *
     * @psalm-readonly
     *
     * @var int|null
     */
    public $livePeriod;
}
