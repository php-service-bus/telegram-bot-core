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
 * The member's status in the chat.
 *
 * @psalm-immutable
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

    public static function create(string $value): static
    {
        if (\in_array($value, self::LIST, true) === false)
        {
            throw new \InvalidArgumentException(\sprintf('Incorrect chat member status: %s', $value));
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
