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
 * @see https://core.telegram.org/bots/api#html-style
 * @see https://core.telegram.org/bots/api#markdown-style
 */
final class ParseMode implements Enum
{
    private const HTML     = 'HTML';

    private const MARKDOWN = 'Markdown';

    private const LIST     = [
        self::HTML,
        self::MARKDOWN,
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
            throw new \InvalidArgumentException(\sprintf('Incorrect parse mode type: %s', $value));
        }

        return new self($value);
    }

    public static function markdown(): self
    {
        return new self(self::MARKDOWN);
    }

    public static function html(): self
    {
        return new self(self::HTML);
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
