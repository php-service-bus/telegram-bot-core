<?php

/**
 * Telegram TelegramBot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 0);

namespace ServiceBus\TelegramBot\Serializer;

/**
 * Telegram messages serializer.
 */
interface TelegramSerializer
{
    /**
     * Decode received message.
     *
     * @template T
     * @psalm-param class-string<T> $toClass
     * @psalm-return T
     *
     * @throws \ServiceBus\TelegramBot\Serializer\SerializationFailed
     *
     * @return object
     */
    public function decode(array $payload, string $toClass): object;
}
