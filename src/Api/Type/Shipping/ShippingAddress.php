<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Type\Shipping;

/**
 * Represents a shipping address.
 *
 * @see https://core.telegram.org/bots/api#shippingaddress
 *
 * @property-read string      $countryCode
 * @property-read string|null $state
 * @property-read string      $city
 * @property-read string      $streetLine1
 * @property-read string|null $streetLine2
 * @property-read string      $postCode
 */
final class ShippingAddress
{
    /**
     * ISO 3166-1 alpha-2 country code.
     *
     * @var string
     */
    public $countryCode;

    /**
     * State, if applicable.
     *
     * @var string|null
     */
    public $state;

    /**
     * City.
     *
     * @var string
     */
    public $city;

    /**
     * First line for the address.
     *
     * @var string
     */
    public $streetLine1;

    /**
     * Second line for the address.
     *
     * @var string|null
     */
    public $streetLine2;

    /**
     * Address post code.
     *
     * @var string
     */
    public $postCode;
}
