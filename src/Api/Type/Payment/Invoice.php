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

/**
 * Contains basic information about an invoice.
 *
 * @see https://core.telegram.org/bots/api#invoice
 *
 * @property-read string $title
 * @property-read string $description
 * @property-read string $startParameter
 * @property-read Money  $amount
 */
final class Invoice
{
    /**
     * Product name.
     *
     * @var string
     */
    public $title;

    /**
     * Product description.
     *
     * @var string
     */
    public $description;

    /**
     * Unique bot deep-linking parameter that can be used to generate this invoice.
     *
     * @var string
     */
    public $startParameter;

    /**
     * Total price.
     *
     * @var Money
     */
    public $amount;
}
