<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Type\Chat;

/**
 * Contains information about why a request was unsuccessful.
 *
 * @see https://core.telegram.org/bots/api#responseparameters
 *
 * @psalm-immutable
 */
final class ResponseParameters
{
    /**
     * Optional. The group has been migrated to a supergroup with the specified identifier. This number may be greater
     * than 32 bits and some programming languages may have difficulty/silent defects in interpreting it. But it is
     * smaller than 52 bits, so a signed 64 bit integer or double-precision float type are safe for storing this
     * identifier.
     *
     * @psalm-readonly
     *
     * @var ChatId|null
     */
    public $migrateToChatId;

    /**
     * Optional. In case of exceeding flood control, the number of seconds left to wait before the request can be
     * repeated.
     *
     * @psalm-readonly
     *
     * @var int|null
     */
    public $retryAfter;
}
