<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Type\Location;

/**
 * Represents a venue.
 *
 * @see https://core.telegram.org/bots/api#venue
 *
 * @psalm-immutable
 */
final class Venue
{
    /**
     * Venue location.
     *
     * @psalm-readonly
     *
     * @var Location
     */
    public $location;

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
     * Optional. Foursquare identifier of the venue.
     *
     * @psalm-readonly
     *
     * @var string|null
     */
    public $foursquareId;

    /**
     * Optional. Foursquare type of the venue. (For example, “arts_entertainment/default”,
     * “arts_entertainment/aquarium” or “food/icecream”.).
     *
     * @psalm-readonly
     *
     * @var string|null
     */
    public $foursquareType;
}
