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

use ServiceBus\TelegramBot\Api\Type\User\User;

/**
 * Contains information about an incoming shipping query.
 *
 * @see https://core.telegram.org/bots/api#shippingquery
 *
 * @psalm-immutable
 */
final class ShippingQuery
{
    /**
     * Unique query identifier.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $id;

    /**
     * User who sent the query.
     *
     * @psalm-readonly
     *
     * @var User
     */
    public $from;

    /**
     * Bot specified invoice payload.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $invoicePayload;

    /**
     * User specified shipping address.
     *
     * @psalm-readonly
     *
     * @var ShippingAddress
     */
    public $shippingAddress;
}
