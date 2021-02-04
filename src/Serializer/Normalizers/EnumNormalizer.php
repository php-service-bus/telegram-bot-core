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

use ServiceBus\TelegramBot\Api\Type\Enum;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Enum types normalizer.
 */
final class EnumNormalizer implements NormalizerInterface, DenormalizerInterface
{
    public function normalize($object, string $format = null, array $context = []): string
    {
        /** @var Enum $object */

        return $object->toString();
    }

    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof Enum;
    }

    /**
     * @psalm-suppress MoreSpecificImplementedParamType
     *
     * @psalm-param string $data
     */
    public function denormalize($data, string $type, string $format = null, array $context = []): ?Enum
    {
        if ($data !== '')
        {
            /**
             * @noinspection PhpUndefinedMethodInspection
             *
             * @psalm-var class-string<\ServiceBus\TelegramBot\Api\Type\Enum> $type
             *
             * @var Enum $enum
             */
            $enum = $type::create($data);

            return $enum;
        }

        return null;
    }

    public function supportsDenormalization($data, string $type, string $format = null): bool
    {
        return \is_a($type, Enum::class, true);
    }
}
