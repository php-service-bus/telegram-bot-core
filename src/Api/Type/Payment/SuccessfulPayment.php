<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types=0);

namespace ServiceBus\TelegramBot\Api\Type\Payment;

use Money\Money;
use ServiceBus\TelegramBot\Api\Type\Order\OrderInfo;

/**
 * Contains basic information about a successful payment.
 *
 * @see https://core.telegram.org/bots/api#successfulpayment
 *
 * @psalm-immutable
 */
final class SuccessfulPayment
{
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

    /**
     * Telegram payment identifier.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $telegramPaymentChargeId;

    /**
     * Provider payment identifier.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $providerPaymentChargeId;
}
