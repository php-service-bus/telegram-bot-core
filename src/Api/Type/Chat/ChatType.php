<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types=0);

namespace ServiceBus\TelegramBot\Api\Type\Chat;

use ServiceBus\TelegramBot\Api\Type\Enum;

/**
 * Type of chat.
 */
final class ChatType implements Enum
{
    private const PRIVATE = 'private';

    private const GROUP = 'group';

    private const SUPER_GROUP = 'supergroup';

    private const CHANNEL = 'channel';

    private const LIST    = [
        self::PRIVATE,
        self::GROUP,
        self::SUPER_GROUP,
        self::CHANNEL,
    ];

    /**
     * @var string
     */
    private $value;

    public static function create(string $value): static
    {
        if (\in_array($value, self::LIST, true) === false)
        {
            throw new \InvalidArgumentException(\sprintf('Incorrect chat type: %s', $value));
        }

        return new self($value);
    }

    public static function group(): self
    {
        return new self(self::GROUP);
    }

    public static function superGroup(): self
    {
        return new self(self::SUPER_GROUP);
    }

    public static function private(): self
    {
        return new self(self::PRIVATE);
    }

    public static function channel(): self
    {
        return new self(self::CHANNEL);
    }

    public function equals(ChatType $type): bool
    {
        return $this->value === $type->value;
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
