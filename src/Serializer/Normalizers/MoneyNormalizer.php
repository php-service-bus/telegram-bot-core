<?php

/**
 * Telegram TelegramBot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Serializer\Normalizers;

use Money\Currency;
use Money\Money;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Money data normalizer.
 */
final class MoneyNormalizer implements DenormalizerInterface, NormalizerInterface
{
    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = []): array
    {
        /** @var Money $object */

        return [
            'currency'     => $object->getCurrency()->getCode(),
            'total_amount' => $object->getAmount(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null): bool
    {
        return $data instanceof Money;
    }

    /**
     * {@inheritdoc}
     *
     * @psalm-param    array{currency: string, total_amount: string} $data
     *
     * @psalm-suppress MoreSpecificImplementedParamType
     * @psalm-suppress ImplementedReturnTypeMismatch
     */
    public function denormalize($data, $class, $format = null, array $context = []): ?Money
    {
        if (isset($data['currency'], $data['total_amount']))
        {
            try
            {
                return new Money($data['total_amount'], new Currency($data['currency']));
            }
            catch (\Throwable $throwable)
            {
            }
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return Money::class === $type;
    }
}
