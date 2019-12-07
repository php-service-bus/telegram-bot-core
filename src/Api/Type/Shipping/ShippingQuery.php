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

use ServiceBus\TelegramBot\Api\Type\User\User;

/**
 * Contains information about an incoming shipping query.
 *
 * @see https://core.telegram.org/bots/api#shippingquery
 *
 * @psalm-readonly
 */
final class ShippingQuery
{
    /**
     * Unique query identifier.
     *
     * @var string
     */
    public $id;

    /**
     * User who sent the query.
     *
     * @var User
     */
    public $from;

    /**
     * Bot specified invoice payload.
     *
     * @var string
     */
    public $invoicePayload;

    /**
     * User specified shipping address.
     *
     * @var ShippingAddress
     */
    public $shippingAddress;
}
