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
 * Represents the content of a venue message to be sent as the result of an inline query.
 *
 * @see https://core.telegram.org/bots/api#inputvenuemessagecontent
 *
 * @psalm-immutable
 */
final class InputVenueMessageContent implements InputMessageContent
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
     * Name of the venue.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $title;

    /**
     * Address of the venue.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $address;

    /**
     * Optional. Foursquare identifier of the venue, if known.
     *
     * @psalm-readonly
     *
     * @var string|null
     */
    public $foursquareId;

    /**
     * Optional. Foursquare type of the venue, if known. (For example, “arts_entertainment/default”,
     * “arts_entertainment/aquarium” or “food/icecream”.).
     *
     * @psalm-readonly
     *
     * @var string|null
     */
    public $foursquareType;
}
