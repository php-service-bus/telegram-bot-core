<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Type;

/**
 * Enum marker interface.
 */
interface Enum
{
    /**
     * @throws \InvalidArgumentException
     *
     * @return static
     */
    public static function create(string $value): static;

    public function toString(): string;
}
