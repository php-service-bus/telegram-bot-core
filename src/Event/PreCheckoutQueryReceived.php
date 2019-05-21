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

use ServiceBus\TelegramBot\Api\Type\Order\PreCheckoutQuery;
use ServiceBus\TelegramBot\Bot\TelegramBot;

/**
 * New pre-checkout query received.
 */
final class PreCheckoutQueryReceived implements TelegramEvent
{
    /**
     * @var TelegramBot
     */
    private $bot;

    /**
     * @var PreCheckoutQuery
     */
    private $preCheckoutQuery;

    /**
     * @param TelegramBot      $bot
     * @param PreCheckoutQuery $preCheckoutQuery
     *
     * @return self
     */
    public static function create(TelegramBot $bot, PreCheckoutQuery $preCheckoutQuery): self
    {
        return new self($bot, $preCheckoutQuery);
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
     * {@inheritdoc}
     */
    public function bot(): TelegramBot
    {
        return $this->bot;
    }

    /**
     * @param TelegramBot      $bot
     * @param PreCheckoutQuery $preCheckoutQuery
     */
    private function __construct(TelegramBot $bot, PreCheckoutQuery $preCheckoutQuery)
    {
        $this->bot              = $bot;
        $this->preCheckoutQuery = $preCheckoutQuery;
    }
}
