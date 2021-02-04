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

use ServiceBus\MessageSerializer\Symfony\SymfonySerializer;
use ServiceBus\TelegramBot\Serializer\Normalizers\ChatIdNormalizer;
use ServiceBus\TelegramBot\Serializer\Normalizers\EnumNormalizer;
use ServiceBus\TelegramBot\Serializer\Normalizers\MessageIdNormalizer;
use ServiceBus\TelegramBot\Serializer\Normalizers\MoneyNormalizer;
use ServiceBus\TelegramBot\Serializer\Normalizers\UnixTimeNormalizer;
use ServiceBus\TelegramBot\Serializer\Normalizers\UserIdNormalizer;

/**
 * Symfony serializer wrapper.
 */
final class WrappedSymfonySerializer implements TelegramSerializer
{
    /**
     * @var SymfonySerializer
     */
    private $serializer;

    public function __construct()
    {
        $this->serializer = new SymfonySerializer([
            new MoneyNormalizer(),
            new EnumNormalizer(),
            new UnixTimeNormalizer(),
            new ChatIdNormalizer(),
            new UserIdNormalizer(),
            new MessageIdNormalizer()
        ]);
    }

    public function decode(array $payload, string $toClass): object
    {
        try
        {
            /** @psalm-suppress DocblockTypeContradiction */
            if (\is_a($toClass, \IteratorAggregate::class, true))
            {
                $payload = ['list' => $payload];
            }

            return $this->serializer->denormalize($payload, $toClass);
        }
        catch (\Throwable $throwable)
        {
            throw new SerializationFailed($throwable->getMessage(), (int) $throwable->getCode(), $throwable);
        }
    }
}
