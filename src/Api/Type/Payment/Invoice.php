<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 0);

namespace ServiceBus\TelegramBot\Api\Type\Payment;

use Money\Money;

/**
 * Contains basic information about an invoice.
 *
 * @see https://core.telegram.org/bots/api#invoice
 *
 * @psalm-immutable
 */
final class Invoice
{
    /**
     * Product name.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $title;

    /**
     * Product description.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $description;

    /**
     * Unique bot deep-linking parameter that can be used to generate this invoice.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $startParameter;

    /**
     * Total price.
     *
     * @psalm-readonly
     *
     * @var Money
     */
    public $amount;
}
