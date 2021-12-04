<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types=0);

namespace ServiceBus\TelegramBot\Api\Type\Order;

use ServiceBus\TelegramBot\Api\Type\Shipping\ShippingAddress;

/**
 * Represents information about an order.
 *
 * @see https://core.telegram.org/bots/api#orderinfo
 *
 * @psalm-immutable
 */
final class OrderInfo
{
    /**
     * Optional. User name.
     *
     * @psalm-readonly
     *
     * @var string|null
     */
    public $name;

    /**
     * Optional. User's phone number.
     *
     * @psalm-readonly
     *
     * @var string|null
     */
    public $phoneNumber;

    /**
     * Optional. User email.
     *
     * @psalm-readonly
     *
     * @var string|null
     */
    public $email;

    /**
     * Optional. User shipping address.
     *
     * @psalm-readonly
     *
     * @var ShippingAddress|null
     */
    public $shippingAddress;
}
