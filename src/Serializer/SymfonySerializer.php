<?php

/**
 * Telegram TelegramBot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Serializer;

use ServiceBus\TelegramBot\Serializer\Normalizers\ChatIdNormalizer;
use ServiceBus\TelegramBot\Serializer\Normalizers\EmptyDataNormalizer;
use ServiceBus\TelegramBot\Serializer\Normalizers\EnumNormalizer;
use ServiceBus\TelegramBot\Serializer\Normalizers\MessageIdNormalizer;
use ServiceBus\TelegramBot\Serializer\Normalizers\MoneyNormalizer;
use ServiceBus\TelegramBot\Serializer\Normalizers\PropertyNameConverter;
use ServiceBus\TelegramBot\Serializer\Normalizers\PropertyNormalizerWrapper;
use ServiceBus\TelegramBot\Serializer\Normalizers\UnixTimeNormalizer;
use ServiceBus\TelegramBot\Serializer\Normalizers\UserIdNormalizer;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Symfony serializer wrapper.
 */
final class SymfonySerializer implements TelegramSerializer
{
    /**
     * @var Serializer
     */
    private $normalizer;

    public function __construct()
    {
        $this->normalizer = new Serializer(
            [
                new MoneyNormalizer(),
                new EnumNormalizer(),
                new UnixTimeNormalizer(),
                new ChatIdNormalizer(),
                new UserIdNormalizer(),
                new MessageIdNormalizer(),
                new DateTimeNormalizer(['datetime_format' => 'c']),
                new ArrayDenormalizer(),
                new PropertyNormalizerWrapper(null, new PropertyNameConverter(), new PhpDocExtractor()),
                new EmptyDataNormalizer(),
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function decode(array $payload, string $toClass): object
    {
        try
        {
            if (true === \is_a($toClass, \IteratorAggregate::class, true))
            {
                $payload = ['list' => $payload];
            }

            return $this->normalizer->denormalize($payload, $toClass, null, ['enable_max_depth' => true]);
        }
        catch (\Throwable $throwable)
        {
            throw new SerializationFailed($throwable->getMessage(), (int) $throwable->getCode(), $throwable);
        }
    }
}
