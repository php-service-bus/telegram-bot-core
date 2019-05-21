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

use Money\Money;
use ServiceBus\TelegramBot\Api\Type\User\User;

/**
 * Contains information about an incoming pre-checkout query.
 *
 * @see https://core.telegram.org/bots/api#precheckoutquery
 *
 * @property-read string         $id
 * @property-read User           $from
 * @property-read Money          $amount
 * @property-read string         $invoicePayload
 * @property-read string|null    $shippingOptionId
 * @property-read OrderInfo|null $orderInfo
 */
final class PreCheckoutQuery
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
     * Total price.
     *
     * @var Money
     */
    public $amount;

    /**
     * Bot specified invoice payload.
     *
     * @var string
     */
    public $invoicePayload;

    /**
     * Optional. Identifier of the shipping option chosen by the user.
     *
     * @var string|null
     */
    public $shippingOptionId;

    /**
     * Optional. Order info provided by the user.
     *
     * @var OrderInfo|null
     */
    public $orderInfo;
}
