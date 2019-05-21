<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Type\Chat;

use ServiceBus\TelegramBot\Api\Type\Enum;

/**
 * Type of chat.
 */
final class ChatType implements Enum
{
    private const PRIVATE     = 'private';

    private const GROUP       = 'group';

    private const SUPER_GROUP = 'supergroup';

    private const CHANNEL     = 'channel';

    private const LIST        = [
        self::PRIVATE,
        self::GROUP,
        self::SUPER_GROUP,
        self::CHANNEL,
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
            throw new \InvalidArgumentException(\sprintf('Incorrect chat type: %s', $value));
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
