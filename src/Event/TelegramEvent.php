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

use ServiceBus\TelegramBot\Bot\TelegramBot;

/**
 * Incoming telegram event.
 */
interface TelegramEvent
{
    /**
     * Receive event payload.
     *
     * @return object
     */
    public function payload(): object;

    /**
     * Receive bot.
     *
     * @return TelegramBot
     */
    public function bot(): TelegramBot;
}
