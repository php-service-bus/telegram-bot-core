<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Type\Passport;

/**
 * Represents an issue in an unspecified place. The error is considered resolved when new data is added.
 *
 * @see https://core.telegram.org/bots/api#passportelementerrorunspecified
 *
 * @psalm-readonly
 */
final class PassportElementErrorUnspecified
{
    /**
     * Error source, must be unspecified.
     *
     * @var string
     */
    public $source;

    /**
     * Type of element of the user's Telegram Passport which has the issue.
     *
     * @var string
     */
    public $type;

    /**
     * Base64-encoded element hash.
     *
     * @var string
     */
    public $elementHash;

    /**
     * Error message.
     *
     * @var string
     */
    public $message;
}
