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
 * @psalm-readonly
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
