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
     * {@inheritdoc}
     */
    public static function create(string $value): self
    {
        if (false === \in_array($value, self::LIST, true))
        {
            throw new \InvalidArgumentException(\sprintf('Incorrect parse mode type: %s', $value));
        }

        return new self($value);
    }

    /**
     * @return self
     */
    public static function markdown(): self
    {
        return new self(self::MARKDOWN);
    }

    /**
     * @return self
     */
    public static function html(): self
    {
        return new self(self::HTML);
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
