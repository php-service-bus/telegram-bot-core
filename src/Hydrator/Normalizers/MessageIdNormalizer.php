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

use ServiceBus\TelegramBot\Api\Type\Message\MessageId;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class MessageIdNormalizer implements DenormalizerInterface, NormalizerInterface
{
    public function normalize(mixed $data, string $format = null, array $context = []): string
    {
        /** @var MessageId $data */
        return $data->toString();
    }

    public function supportsNormalization(mixed $data, string $format = null, array $context = []): bool
    {
        return $data instanceof MessageId;
    }

    /**
     * @psalm-suppress MoreSpecificImplementedParamType
     *
     * @psalm-param  string|int|null $data
     */
    public function denormalize(mixed $data, string $type, string $format = null, array $context = []): ?MessageId
    {
        if ((string) $data !== '') {
            return new MessageId((string) $data);
        }

        return null;
    }

    public function supportsDenormalization(mixed $data, string $type, string $format = null, array $context = []): bool
    {
        return $type === MessageId::class && (is_string($data) || is_int($data) || $data === null);
    }

    /**
     * @return array<class-string, bool>
     */
    public function getSupportedTypes(?string $format): array
    {
        return [
            MessageId::class => false
        ];
    }
}
