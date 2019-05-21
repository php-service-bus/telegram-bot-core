<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Serializer\Normalizers;

use ServiceBus\TelegramBot\Api\Type\Chat\ChatId;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 *
 */
final class ChatIdNormalizer implements DenormalizerInterface, NormalizerInterface
{
    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = []): string
    {
        /** @var ChatId $object */

        return $object->toString();
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null): bool
    {
        return $data instanceof ChatId;
    }

    /**
     * {@inheritdoc}
     *
     * @psalm-param    string|int $data
     *
     * @psalm-suppress MoreSpecificImplementedParamType
     * @psalm-suppress ImplementedReturnTypeMismatch
     */
    public function denormalize($data, $class, $format = null, array $context = []): ?ChatId
    {
        if ('' !== (string) $data)
        {
            return new ChatId((string) $data);
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, $type, $format = null): bool
    {
        return ChatId::class === $type;
    }
}
