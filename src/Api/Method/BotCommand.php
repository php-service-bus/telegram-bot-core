<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Method;

/**
 * Bot action interface.
 */
interface BotCommand
{
    /**
     * Receive bot command name.
     *
     * @return string
     */
    public function methodName(): string;

    /**
     * Receive http request method.
     *
     * @return string
     */
    public function httpRequestMethod(): string;

    /**
     * Receive request parameters.
     *
     * @return array
     */
    public function requestData(): array;

    /**
     * Receive response type class namespace.
     *
     * @return string
     */
    public function typeClass(): string;
}
