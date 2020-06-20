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

use ServiceBus\TelegramBot\Api\Type\Message\MessageId;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 *
 */
final class MessageIdNormalizer implements DenormalizerInterface, NormalizerInterface
{
    /**
     * {@inheritdoc}
     */
    public function normalize($object, string $format = null, array $context = []): string
    {
        /** @var MessageId $object */

        return $object->toString();
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof MessageId;
    }

    /**
     * {@inheritdoc}
     *
     * @psalm-param    string|int $data
     *
     * @psalm-suppress MoreSpecificImplementedParamType
     * @psalm-suppress ImplementedReturnTypeMismatch
     */
    public function denormalize($data, string $type, string $format = null, array $context = []): ?MessageId
    {
        if ('' !== (string) $data)
        {
            return new MessageId((string) $data);
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, string $type, string $format = null): bool
    {
        return MessageId::class === $type;
    }
}
