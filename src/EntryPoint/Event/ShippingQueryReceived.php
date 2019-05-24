<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\EntryPoint\Event;

use ServiceBus\TelegramBot\Api\Type\Shipping\ShippingQuery;
use ServiceBus\TelegramBot\Api\Type\Update;

/**
 * New shipping query received.
 */
final class ShippingQueryReceived implements TelegramEvent
{
    /**
     * @var ShippingQuery
     */
    private $shippingQuery;

    /**
     * {@inheritdoc}
     */
    public static function supports(Update $update): bool
    {
        return null !== $update->shippingQuery;
    }

    /**
     * {@inheritdoc}
     */
    public static function fromUpdate(Update $update): TelegramEvent
    {
        if (null !== $update->shippingQuery)
        {
            return new self($update->shippingQuery);
        }

        throw new \LogicException('Incorrect update passed');
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
     * @param ShippingQuery $shippingQuery
     */
    private function __construct(ShippingQuery $shippingQuery)
    {
        $this->shippingQuery = $shippingQuery;
    }
}
