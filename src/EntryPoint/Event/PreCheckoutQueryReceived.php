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

use ServiceBus\TelegramBot\Api\Type\Order\PreCheckoutQuery;
use ServiceBus\TelegramBot\Api\Type\Update;

/**
 * New pre-checkout query received.
 *
 * @psalm-readonly
 */
final class PreCheckoutQueryReceived implements TelegramEvent
{
    /**
     * @var PreCheckoutQuery
     */
    public $preCheckoutQuery;

    /**
     * {@inheritdoc}
     */
    public static function supports(Update $update): bool
    {
        return null !== $update->preCheckoutQuery;
    }

    /**
     * {@inheritdoc}
     */
    public static function fromUpdate(Update $update): TelegramEvent
    {
        if (null !== $update->preCheckoutQuery)
        {
            return new self($update->preCheckoutQuery);
        }

        throw new \LogicException('Incorrect update passed');
    }

    /**
     * {@inheritdoc}
     *
     * @return PreCheckoutQuery
     */
    public function payload(): object
    {
        return $this->preCheckoutQuery;
    }

    /**
     * @param PreCheckoutQuery $preCheckoutQuery
     */
    private function __construct(PreCheckoutQuery $preCheckoutQuery)
    {
        $this->preCheckoutQuery = $preCheckoutQuery;
    }
}
