<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Serializer;

/**
 * Telegram messages serializer.
 */
interface TelegramSerializer
{
    /**
     * Decode received message.
     *
     * @param array $payload
     * @param string $toClass
     *
     * @throws \ServiceBus\TelegramBot\Serializer\SerializationFailed
     *
     * @return object
     */
    public function decode(array $payload, string $toClass): object;
}
