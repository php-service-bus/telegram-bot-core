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
 * Represents the content of a venue message to be sent as the result of an inline query.
 *
 * @see https://core.telegram.org/bots/api#inputvenuemessagecontent
 *
 * @property-read Location    $coordinates
 * @property-read string      $title
 * @property-read string      $address
 * @property-read string|null $foursquareId
 * @property-read string|null $foursquareType
 */
final class InputVenueMessageContent implements InputMessageContent
{
    /**
     * Coordinates.
     *
     * @var Location
     */
    public $coordinates;

    /**
     * Name of the venue.
     *
     * @var string
     */
    public $title;

    /**
     * Address of the venue.
     *
     * @var string
     */
    public $address;

    /**
     * Optional. Foursquare identifier of the venue, if known.
     *
     * @var string|null
     */
    public $foursquareId;

    /**
     * Optional. Foursquare type of the venue, if known. (For example, “arts_entertainment/default”,
     * “arts_entertainment/aquarium” or “food/icecream”.).
     *
     * @var string|null
     */
    public $foursquareType;
}
