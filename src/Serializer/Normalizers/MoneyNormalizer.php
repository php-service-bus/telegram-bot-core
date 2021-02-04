<?php

/**
 * Telegram TelegramBot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 0);

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
    public function normalize($object, string $format = null, array $context = []): array
    {
        /** @var Money $object */

        return [
            'currency'     => $object->getCurrency()->getCode(),
            'total_amount' => $object->getAmount(),
        ];
    }

    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof Money;
    }

    /**
     * @psalm-suppress MoreSpecificImplementedParamType
     *
     * @psalm-param array{currency: string, total_amount: string} $data
     */
    public function denormalize($data, string $type, string $format = null, array $context = []): ?Money
    {
        if (isset($data['currency'], $data['total_amount']))
        {
            try
            {
                return new Money($data['total_amount'], new Currency($data['currency']));
            }
            catch (\Throwable)
            {
            }
        }

        return null;
    }

    public function supportsDenormalization($data, string $type, string $format = null): bool
    {
        return $type === Money::class;
    }
}
