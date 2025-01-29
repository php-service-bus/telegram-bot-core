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

use ServiceBus\TelegramBot\Api\Type\User\UserId;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class UserIdNormalizer implements DenormalizerInterface, NormalizerInterface
{
    public function normalize(mixed $data, string $format = null, array $context = []): string
    {
        /** @var UserId $data */
        return $data->toString();
    }

    public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
    {
        return $data instanceof UserId;
    }

    /**
     * @psalm-suppress MoreSpecificImplementedParamType
     *
     * @psalm-param string|int|null $data
     */
    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): ?UserId
    {
        if ((string) $data !== '') {
            return new UserId((string) $data);
        }

        return null;
    }

    public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []): bool
    {
        return $type === UserId::class && (is_string($data) || is_int($data) || $data === null);
    }

    /**
     * @return array<class-string, bool>
     */
    public function getSupportedTypes(?string $format): array
    {
        return [
            UserId::class => false
        ];
    }
}
