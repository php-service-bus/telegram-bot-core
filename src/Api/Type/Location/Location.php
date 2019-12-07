<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Type\Location;

/**
 * Represents a point on the map.
 *
 * @see https://core.telegram.org/bots/api#location
 *
 * @psalm-readonly
 */
final class Location
{
    /**
     * Longitude.
     *
     * @var float
     */
    public $longitude;

    /**
     * Latitude.
     *
     * @var float
     */
    public $latitude;

    /**
     * @param float $longitude
     * @param float $latitude
     *
     * @return self
     */
    public static function create(float $longitude, float $latitude): self
    {
        return new self($longitude, $latitude);
    }

    /**
     * @param float $longitude
     * @param float $latitude
     */
    private function __construct(float $longitude, float $latitude)
    {
        $this->longitude = $longitude;
        $this->latitude  = $latitude;
    }
}
