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

use Money\Money;
use ServiceBus\TelegramBot\Api\Type\User\User;

/**
 * Contains information about an incoming pre-checkout query.
 *
 * @see https://core.telegram.org/bots/api#precheckoutquery
 *
 * @psalm-immutable
 */
final class PreCheckoutQuery
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
     * Total price.
     *
     * @psalm-readonly
     *
     * @var Money
     */
    public $amount;

    /**
     * Bot specified invoice payload.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $invoicePayload;

    /**
     * Optional. Identifier of the shipping option chosen by the user.
     *
     * @psalm-readonly
     *
     * @var string|null
     */
    public $shippingOptionId;

    /**
     * Optional. Order info provided by the user.
     *
     * @psalm-readonly
     *
     * @var OrderInfo|null
     */
    public $orderInfo;
}
