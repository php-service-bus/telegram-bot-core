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
 * The member's status in the chat.
 *
 * @psalm-readonly
 */
final class ChatMemberStatus implements Enum
{
    private const CREATOR       = 'creator';

    private const ADMINISTRATOR = 'administrator';

    private const MEMBER        = 'member';

    private const RESTRICTED    = 'restricted';

    private const LEFT          = 'left';

    private const KICKED        = 'kicked';

    private const LIST          = [
        self::CREATOR,
        self::ADMINISTRATOR,
        self::MEMBER,
        self::RESTRICTED,
        self::LEFT,
        self::KICKED,
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
            throw new \InvalidArgumentException(\sprintf('Incorrect chat member status: %s', $value));
        }

        return new self($value);
    }

    /**
     * {@inheritdoc}
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
