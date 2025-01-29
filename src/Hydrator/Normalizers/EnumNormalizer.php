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

use ServiceBus\TelegramBot\Api\Type\Enum;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class EnumNormalizer implements NormalizerInterface, DenormalizerInterface
{
    public function normalize(mixed $data, string $format = null, array $context = []): string
    {
        /** @var Enum $data */
        return $data->toString();
    }

    public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
    {
        return $data instanceof Enum;
    }

    /**
     * @psalm-suppress MoreSpecificImplementedParamType
     *
     * @psalm-param string|null $data
     */
    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): ?Enum
    {
        if ((string) $data !== '') {
            /** @psalm-var class-string<Enum> $type */
            return $type::create((string) $data);
        }

        return null;
    }

    public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []): bool
    {
        return \is_a($type, Enum::class, true) && (is_string($data) || $data === null);
    }

    /**
     * @return array<class-string, bool>
     */
    public function getSupportedTypes(?string $format): array
    {
        return [
            Enum::class => false
        ];
    }
}
