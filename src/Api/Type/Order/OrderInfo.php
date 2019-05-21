<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Type\Order;

use ServiceBus\TelegramBot\Api\Type\Shipping\ShippingAddress;

/**
 * Represents information about an order.
 *
 * @see https://core.telegram.org/bots/api#orderinfo
 *
 * @property-read string|null          $name
 * @property-read string|null          $phoneNumber
 * @property-read string|null          $email
 * @property-read ShippingAddress|null $shippingAddress
 */
final class OrderInfo
{
    /**
     * Optional. User name.
     *
     * @var string|null
     */
    public $name;

    /**
     * Optional. User's phone number.
     *
     * @var string|null
     */
    public $phoneNumber;

    /**
     * Optional. User email.
     *
     * @var string|null
     */
    public $email;

    /**
     * Optional. User shipping address.
     *
     * @var ShippingAddress|null
     */
    public $shippingAddress;
}
