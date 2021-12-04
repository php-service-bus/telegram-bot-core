<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types=0);

namespace ServiceBus\TelegramBot\Api\Type\Location;

/**
 * Represents a point on the map.
 *
 * @see https://core.telegram.org/bots/api#location
 *
 * @psalm-immutable
 */
final class Location
{
    /**
     * Longitude.
     *
     * @psalm-readonly
     *
     * @var float
     */
    public $longitude;

    /**
     * Latitude.
     *
     * @psalm-readonly
     *
     * @var float
     */
    public $latitude;

    public static function create(float $longitude, float $latitude): self
    {
        return new self($longitude, $latitude);
    }

    private function __construct(float $longitude, float $latitude)
    {
        $this->longitude = $longitude;
        $this->latitude  = $latitude;
    }
}
