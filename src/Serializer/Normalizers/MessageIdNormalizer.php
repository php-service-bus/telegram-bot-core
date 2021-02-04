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

use ServiceBus\TelegramBot\Api\Type\Message\MessageId;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 *
 */
final class MessageIdNormalizer implements DenormalizerInterface, NormalizerInterface
{
    public function normalize($object, string $format = null, array $context = []): string
    {
        /** @var MessageId $object */

        return $object->toString();
    }

    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof MessageId;
    }

    /**
     * @psalm-suppress MoreSpecificImplementedParamType
     *
     * @psalm-param  string|int $data
     */
    public function denormalize($data, string $type, string $format = null, array $context = []): ?MessageId
    {
        if ((string) $data !== '')
        {
            return new MessageId((string) $data);
        }

        return null;
    }

    public function supportsDenormalization($data, string $type, string $format = null): bool
    {
        return $type === MessageId::class;
    }
}
