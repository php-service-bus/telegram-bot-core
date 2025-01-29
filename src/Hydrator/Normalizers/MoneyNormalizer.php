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
    public function normalize(mixed $data, string $format = null, array $context = []): array
    {
        /** @var Money $data */
        return [
            'currency'     => $data->getCurrency()->getCode(),
            'total_amount' => $data->getAmount(),
        ];
    }

    public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
    {
        return $data instanceof Money;
    }

    /**
     * @psalm-suppress MoreSpecificImplementedParamType
     *
     * @psalm-param array{currency?: non-empty-string, total_amount?: numeric-string}|null $data
     */
    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): ?Money
    {
        if (is_array($data) && isset($data['currency'], $data['total_amount'])) {
            return new Money($data['total_amount'], new Currency($data['currency']));
        }

        return null;
    }

    public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []): bool
    {
        return $type === Money::class && (is_array($data) || $data === null);
    }

    /**
     * @return array<class-string, bool>
     */
    public function getSupportedTypes(?string $format): array
    {
        return [
            Money::class => false
        ];
    }
}
