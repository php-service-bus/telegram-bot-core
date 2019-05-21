<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Type\Message;

use ServiceBus\TelegramBot\Api\Type\Enum;

/**
 * Type of the entity.
 */
final class MessageEntityType implements Enum
{
    private const HASH_TAG     = 'hashtag';

    private const CASH_TAG     = 'cashtag';

    private const BOT_COMMAND  = 'bot_command';

    private const URL          = 'url';

    private const EMAIL        = 'email';

    private const PHONE_NUMBER = 'phone_number';

    private const BOLD         = 'bold';

    private const ITALIC       = 'italic';

    private const CODE         = 'code';

    private const PRE          = 'pre';

    private const TEXT_LINK    = 'text_link';

    private const TEXT_MENTION = 'text_mention';

    private const LIST         = [
        self::HASH_TAG,
        self::CASH_TAG,
        self::BOT_COMMAND,
        self::URL,
        self::EMAIL,
        self::PHONE_NUMBER,
        self::BOLD,
        self::ITALIC,
        self::CODE,
        self::PRE,
        self::TEXT_LINK,
        self::TEXT_MENTION,
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
            throw new \InvalidArgumentException(\sprintf('Incorrect entity type: %s', $value));
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
