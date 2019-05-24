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

use ServiceBus\TelegramBot\Api\Type\Update;

/**
 * Incoming telegram event.
 */
interface TelegramEvent
{
    /**
     * Does this update belong to this event?
     *
     * @param Update $update
     *
     * @return bool
     */
    public static function supports(Update $update): bool;

    /**
     * @param Update $update
     *
     * @throws \LogicException Incorrect update passed
     *
     * @return self
     */
    public static function fromUpdate(Update $update): self;

    /**
     * Receive event payload.
     *
     * @return object
     */
    public function payload(): object;
}
