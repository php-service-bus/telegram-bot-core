<?php

/**
 * Telegram TelegramBot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types=0);

namespace ServiceBus\TelegramBot\Hydrator;

use ServiceBus\MessageSerializer\ObjectDenormalizer;
use ServiceBus\MessageSerializer\Symfony\SymfonyObjectDenormalizer;
use ServiceBus\TelegramBot\Api\Type\SimpleSuccessResponse;
use ServiceBus\TelegramBot\Hydrator\Normalizers;

final class TelegramHydrator
{
    /**
     * @var ObjectDenormalizer
     */
    private $denormalizer;

    public static function default(): self
    {
        return new self(
            new SymfonyObjectDenormalizer([
                new Normalizers\ChatIdNormalizer(),
                new Normalizers\EnumNormalizer(),
                new Normalizers\MessageIdNormalizer(),
                new Normalizers\MoneyNormalizer(),
                new Normalizers\UnixTimeNormalizer(),
                new Normalizers\UserIdNormalizer()
            ])
        );
    }

    public function __construct(ObjectDenormalizer $denormalizer)
    {
        $this->denormalizer = $denormalizer;
    }

    /**
     * @template T of object
     * @psalm-param array<array-key, mixed> $payload
     * @psalm-param class-string<T>         $toClass
     * @psalm-return T
     *
     * @throws \ServiceBus\TelegramBot\Hydrator\SerializationFailed
     */
    public function handle(array $payload, string $toClass): object
    {
        try
        {
            /** @psalm-suppress DocblockTypeContradiction */
            if (\is_a($toClass, \IteratorAggregate::class, true))
            {
                $payload = ['list' => $payload];
            }

            return $this->denormalizer->handle($payload, $toClass);
        }
        catch (\Throwable $throwable)
        {
            throw new SerializationFailed($throwable->getMessage(), (int) $throwable->getCode(), $throwable);
        }
    }
}
