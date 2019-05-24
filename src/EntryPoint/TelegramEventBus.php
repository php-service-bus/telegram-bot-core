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

use ServiceBus\TelegramBot\EntryPoint\Event\TelegramEvent;

/**
 * Event bus.
 */
final class TelegramEventBus
{
    /**
     * Event listeners collection.
     *
     * @psalm-var array<class-string<TelegramEvent>, array<array-key, TelegramEventProcessor>>
     *
     * @var array
     */
    private $listeners = [];

    /**
     * @see         TelegramEvent
     *
     * @psalm-param class-string<TelegramEvent> $event
     *
     * @param string                 $event
     * @param TelegramEventProcessor $handler
     *
     * @return void
     */
    public function addListener(string $event, TelegramEventProcessor $handler): void
    {
        $this->listeners[$event][] = $handler;
    }

    /**
     * Receive listeners for specified event.
     *
     * @param TelegramEvent $event
     *
     * @return TelegramEventProcessor[]
     */
    public function map(TelegramEvent $event): array
    {
        if (true === isset($this->listeners[\get_class($event)]))
        {
            return $this->listeners[\get_class($event)];
        }

        if (true === isset($this->listeners[TelegramEvent::class]))
        {
            return $this->listeners[TelegramEvent::class];
        }

        return [];
    }
}
