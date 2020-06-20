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

use ServiceBus\TelegramBot\Api\Type\Enum;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Enum types normalizer.
 */
final class EnumNormalizer implements NormalizerInterface, DenormalizerInterface
{
    /**
     * {@inheritdoc}
     */
    public function normalize($object, string $format = null, array $context = []): string
    {
        /** @var Enum $object */

        return $object->toString();
    }

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof Enum;
    }

    /**
     * {@inheritdoc}
     *
     * @psalm-suppress ImplementedReturnTypeMismatch
     */
    public function denormalize($data, string $type, string $format = null, array $context = []): ?Enum
    {
        if('' !== (string) $data)
        {
            /**
             * @psalm-var    class-string<\ServiceBus\TelegramBot\Api\Type\Enum> $type
             *
             * @noinspection PhpUndefinedMethodInspection
             *
             * @var Enum $enum
             */
            $enum = $type::create((string) $data);

            return $enum;
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, string $type, string $format = null): bool
    {
        return \is_a($type, Enum::class, true);
    }
}
