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

use ServiceBus\TelegramBot\Api\Type\Common\UnixTime;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 *
 */
final class UnixTimeNormalizer implements NormalizerInterface, DenormalizerInterface
{
    public function normalize($object, string $format = null, array $context = []): int
    {
        /** @var UnixTime $object */

        return $object->extract();
    }

    public function supportsNormalization($data, string $format = null): bool
    {
        return $data instanceof UnixTime;
    }

    /**
     * @psalm-suppress MoreSpecificImplementedParamType
     *
     * @psalm-param  int|null $data
     */
    public function denormalize($data, string $type, string $format = null, array $context = []): ?UnixTime
    {
        if (null !== $data)
        {
            return new UnixTime($data);
        }

        return null;
    }
    public function supportsDenormalization($data, string $type, string $format = null): bool
    {
        return $type === UnixTime::class;
    }
}
