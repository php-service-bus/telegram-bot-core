<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Type;

/**
 * The part of the face relative to which the mask should be placed.
 */
final class MaskPositionType implements Enum
{
    private const FOREHEAD = 'forehead';

    private const EYES     = 'eyes';

    private const MOUTH    = 'mouth';

    private const CHIN     = 'chin';

    private const LIST     = [
        self::FOREHEAD,
        self::EYES,
        self::MOUTH,
        self::CHIN,
    ];

    /**
     * @var string
     */
    private $value;

    /**
     * {@inheritdoc}
     */
    public static function create(string $value): self
    {
        if (false === \in_array($value, self::LIST, true))
        {
            throw new \InvalidArgumentException(\sprintf('Incorrect mask position type: %s', $value));
        }

        return new self($value);
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    private function __construct(string $value)
    {
        $this->value = $value;
    }
}
