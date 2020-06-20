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

use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;

/**
 * Disable the use of the constructor.
 *
 * @noinspection LongInheritanceChainInspection
 */
final class PropertyNormalizerWrapper extends PropertyNormalizer
{
    /**
     * @psalm-var array<string, array<array-key, string>>
     */
    private $localStorage = [];

    /**
     * {@inheritdoc}
     */
    protected function instantiateObject(
        array &$data,
        string $class,
        array &$context,
        \ReflectionClass $reflectionClass,
        $allowedAttributes,
        string $format = null
    ): object {
        return $reflectionClass->newInstanceWithoutConstructor();
    }

    /**
     * {@inheritdoc}
     */
    protected function extractAttributes(object $object, string $format = null, array $context = []): array
    {
        $class = \get_class($object);

        if (false === \array_key_exists($class, $this->localStorage))
        {
            $this->localStorage[$class] = parent::extractAttributes($object, $format, $context);
        }

        return $this->localStorage[$class];
    }

    /**
     * {@inheritdoc}
     *
     * @throws \Error
     */
    protected function getAttributeValue(object $object, string $attribute, string $format = null, array $context = [])
    {
        if (true === isset($object->{$attribute}))
        {
            return $object->{$attribute};
        }

        try
        {
            return parent::getAttributeValue($object, $attribute, $format, $context);
        }
        catch (\Error $error)
        {
            if (false !== \strpos($error->getMessage(), 'must not be accessed before initialization'))
            {
                return null;
            }

            throw $error;
        }
    }

    /**
     * @psalm-param mixed $value
     *
     * {@inheritdoc}
     */
    protected function setAttributeValue(object $object, string $attribute, $value, string $format = null, array $context = []): void
    {
        if (true === isset($object->{$attribute}))
        {
            $object->{$attribute} = $value;

            return;
        }

        parent::setAttributeValue($object, $attribute, $value, $format, $context);
    }
}
