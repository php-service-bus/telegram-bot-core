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
 * Enum marker interface.
 */
interface Enum
{
    /**
     * @param string $value
     *
     * @throws \InvalidArgumentException
     *
     * @return static
     *
     */
    public static function create(string $value);

    /**
     * @return string
     */
    public function toString(): string;
}
