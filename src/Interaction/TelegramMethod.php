<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types=0);

namespace ServiceBus\TelegramBot\Interaction;

use ServiceBus\HttpClient\InputFilePath;

/**
 * Bot action interface.
 */
interface TelegramMethod
{
    /**
     * Receive bot command name.
     *
     * @psalm-return non-empty-string
     */
    public function methodName(): string;

    /**
     * Receive http request method.
     *
     * @return string
     *
     * @psalm-return non-empty-string
     */
    public function httpRequestMethod(): string;

    /**
     * Receive request parameters.
     */
    public function requestData(): array;

    /**
     * Receive response type class namespace.
     *
     * @psalm-return class-string
     *
     * @return string
     */
    public function typeClass(): string;
}
