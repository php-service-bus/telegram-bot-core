<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Event;

use ServiceBus\TelegramBot\Api\Type\Shipping\ShippingQuery;
use ServiceBus\TelegramBot\Bot\TelegramBot;

/**
 * New shipping query received.
 */
final class ShippingQueryReceived implements TelegramEvent
{
    /**
     * @var TelegramBot
     */
    private $bot;

    /**
     * @var ShippingQuery
     */
    private $shippingQuery;

    /**
     * @param TelegramBot   $bot
     * @param ShippingQuery $shippingQuery
     *
     * @return self
     */
    public static function create(TelegramBot $bot, ShippingQuery $shippingQuery): self
    {
        return new self($bot, $shippingQuery);
    }

    /**
     * {@inheritdoc}
     *
     * @return ShippingQuery
     */
    public function payload(): object
    {
        return $this->shippingQuery;
    }

    /**
     * {@inheritdoc}
     */
    public function bot(): TelegramBot
    {
        return $this->bot;
    }

    /**
     * @param TelegramBot   $bot
     * @param ShippingQuery $shippingQuery
     */
    private function __construct(TelegramBot $bot, ShippingQuery $shippingQuery)
    {
        $this->bot           = $bot;
        $this->shippingQuery = $shippingQuery;
    }
}
