<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types=0);

namespace ServiceBus\TelegramBot\Api\Type\Message;

use ServiceBus\TelegramBot\Api\Type\Enum;

/**
 * Type of the entity.
 */
final class MessageEntityType implements Enum
{
    private const HASH_TAG = 'hashtag';

    private const CASH_TAG = 'cashtag';

    private const BOT_COMMAND = 'bot_command';

    private const URL = 'url';

    private const EMAIL = 'email';

    private const PHONE_NUMBER = 'phone_number';

    private const BOLD = 'bold';

    private const ITALIC = 'italic';

    private const CODE = 'code';

    private const PRE = 'pre';

    private const TEXT_LINK = 'text_link';

    private const TEXT_MENTION = 'text_mention';

    private const MENTION = 'mention';


    private const CUSTOM_EMOJI = 'custom_emoji';

    private const UNDERLINE = 'underline';

    private const SPOILER = 'spoiler';

    private const STRIKETHROUGH = 'strikethrough';

    private const BLOCKQUOTE = 'blockquote';

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
        self::MENTION,
        self::CUSTOM_EMOJI,
        self::UNDERLINE,
        self::SPOILER,
        self::STRIKETHROUGH,
        self::BLOCKQUOTE
    ];

    /**
     * @var string
     */
    private $value;

    public static function create(string $value): static
    {
        if (\in_array($value, self::LIST, true) === false)
        {
            throw new \InvalidArgumentException(\sprintf('Incorrect entity type: %s', $value));
        }

        return new self($value);
    }

    public static function hashTag(): self
    {
        return new self(self::HASH_TAG);
    }

    public static function cashTag(): self
    {
        return new self(self::CASH_TAG);
    }

    public static function botCommand(): self
    {
        return new self(self::BOT_COMMAND);
    }

    public static function url(): self
    {
        return new self(self::URL);
    }

    public static function email(): self
    {
        return new self(self::EMAIL);
    }

    public static function phoneNumber(): self
    {
        return new self(self::PHONE_NUMBER);
    }

    public static function bold(): self
    {
        return new self(self::BOLD);
    }

    public static function italic(): self
    {
        return new self(self::ITALIC);
    }

    public static function core(): self
    {
        return new self(self::CODE);
    }

    public static function pre(): self
    {
        return new self(self::PRE);
    }

    public static function textLink(): self
    {
        return new self(self::TEXT_LINK);
    }

    public static function textMention(): self
    {
        return new self(self::TEXT_MENTION);
    }

    public static function mention(): self
    {
        return new self(self::MENTION);
    }

    public static function customEmoji(): self
    {
        return new self(self::CUSTOM_EMOJI);
    }

    public static function underline(): self
    {
        return new self(self::UNDERLINE);
    }

    public static function spoiler(): self
    {
        return new self(self::SPOILER);
    }

    public static function strikethrough(): self
    {
        return new self(self::STRIKETHROUGH);
    }

    public static function blockquote(): self
    {
        return new self(self::BLOCKQUOTE);
    }

    public function equals(MessageEntityType $type): bool
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
