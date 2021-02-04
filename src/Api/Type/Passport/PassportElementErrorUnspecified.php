<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 0);

namespace ServiceBus\TelegramBot\Api\Type\Passport;

/**
 * Represents an issue in an unspecified place. The error is considered resolved when new data is added.
 *
 * @see https://core.telegram.org/bots/api#passportelementerrorunspecified
 *
 * @psalm-immutable
 */
final class PassportElementErrorUnspecified
{
    /**
     * Error source, must be unspecified.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $source;

    /**
     * Type of element of the user's Telegram Passport which has the issue.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $type;

    /**
     * Base64-encoded element hash.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $elementHash;

    /**
     * Error message.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $message;
}
