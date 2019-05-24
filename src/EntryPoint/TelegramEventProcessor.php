<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\EntryPoint;

use Amp\Promise;
use ServiceBus\TelegramBot\EntryPoint\Event\TelegramEvent;

/**
 *
 */
interface TelegramEventProcessor
{
    public function process(TelegramEvent $event): Promise;
}
