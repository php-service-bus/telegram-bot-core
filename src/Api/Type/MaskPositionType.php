<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 0);

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
     * @psalm-suppress MoreSpecificReturnType
     */
    public static function create(string $value): static
    {
        if (\in_array($value, self::LIST, true) === false)
        {
            throw new \InvalidArgumentException(\sprintf('Incorrect mask position type: %s', $value));
        }

        return new self($value);
    }

    public function toString(): string
    {
        return $this->value;
    }

    private function __construct(string $value)
    {
        $this->value = $value;
    }
}
