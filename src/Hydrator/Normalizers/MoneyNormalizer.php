<?php

/**
 * Telegram TelegramBot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types=0);

namespace ServiceBus\TelegramBot\Hydrator\Normalizers;

use Money\Currency;
use Money\Money;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

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
     * @psalm-param array{currency: non-empty-string, total_amount: numeric-string} $data
     */
    public function denormalize($data, string $type, string $format = null, array $context = []): ?Money
    {
        /** @phpstan-ignore-next-line **/
        if (isset($data['currency'], $data['total_amount']))
        {
            return new Money($data['total_amount'], new Currency($data['currency']));
        }

        /** @phpstan-ignore-next-line **/
        return null;
    }

    public function supportsDenormalization($data, string $type, string $format = null): bool
    {
        return $type === Money::class;
    }
}
