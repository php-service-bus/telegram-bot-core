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

use ServiceBus\TelegramBot\Api\Type\Chat\ChatId;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class ChatIdNormalizer implements DenormalizerInterface, NormalizerInterface
{
    public function normalize(mixed $data, string $format = null, array $context = []): string
    {
        /** @var ChatId $data */
        return $data->toString();
    }

    public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
    {
        return $data instanceof ChatId;
    }

    /**
     * @psalm-suppress MoreSpecificImplementedParamType
     *
     * @psalm-param string|int|null $data
     */
    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): ?ChatId
    {
        if ((string) $data !== '') {
            return new ChatId((string) $data);
        }

        return null;
    }

    public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []): bool
    {
        return $type === ChatId::class && (is_string($data) || is_int($data) || $data === null);
    }

    /**
     * @return array<class-string, bool>
     */
    public function getSupportedTypes(?string $format): array
    {
        return [
            ChatId::class => false
        ];
    }
}
