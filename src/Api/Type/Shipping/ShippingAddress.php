<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 0);

namespace ServiceBus\TelegramBot\Api\Type\Shipping;

/**
 * Represents a shipping address.
 *
 * @see https://core.telegram.org/bots/api#shippingaddress
 *
 * @psalm-immutable
 */
final class ShippingAddress
{
    /**
     * ISO 3166-1 alpha-2 country code.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $countryCode;

    /**
     * State, if applicable.
     *
     * @psalm-readonly
     *
     * @var string|null
     */
    public $state;

    /**
     * City.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $city;

    /**
     * First line for the address.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $streetLine1;

    /**
     * Second line for the address.
     *
     * @psalm-readonly
     *
     * @var string|null
     */
    public $streetLine2;

    /**
     * Address post code.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $postCode;
}
