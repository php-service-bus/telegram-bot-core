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

use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

/**
 * Normalizer for an object without attributes (empty).
 */
final class EmptyDataNormalizer implements NormalizerInterface, DenormalizerInterface
{
    /**
     * @psalm-var array<string, array<array-key, string>>
     */
    private $localStorage = [];

    /**
     * {@inheritdoc}
     */
    public function normalize($object, string $format = null, array $context = [])
    {
        return [];
    }

    /**
     * {@inheritdoc}
     *
     * @throws \ReflectionException
     */
    public function supportsNormalization($data, string $format = null): bool
    {
        if (\is_object($data) === true)
        {
            $class = \get_class($data);

            if (isset($this->localStorage[$class]) === false)
            {
                $this->localStorage[$class] = \array_map(
                    static function (\ReflectionProperty $property): string
                    {
                        return (string) $property->name;
                    },
                    (new \ReflectionClass($data))->getProperties()
                );
            }

            return empty($this->localStorage[$class]);
        }

        return false;
    }

    /**
     * {@inheritdoc}
     *
     * @throws \ReflectionException
     */
    public function denormalize($data, string $type, string $format = null, array $context = []): object
    {
        /** @psalm-var class-string $type */

        return (new \ReflectionClass($type))->newInstanceWithoutConstructor();
    }

    /**
     * {@inheritdoc}
     */
    public function supportsDenormalization($data, string $type, string $format = null): bool
    {
        return empty($data);
    }
}
