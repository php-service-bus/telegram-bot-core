<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Type\Payment;

use Money\Money;
use ServiceBus\TelegramBot\Api\Type\Order\OrderInfo;

/**
 * Contains basic information about a successful payment.
 *
 * @see https://core.telegram.org/bots/api#successfulpayment
 *
 * @psalm-readonly
 */
final class SuccessfulPayment
{
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

    /**
     * Telegram payment identifier.
     *
     * @var string
     */
    public $telegramPaymentChargeId;

    /**
     * Provider payment identifier.
     *
     * @var string
     */
    public $providerPaymentChargeId;
}
