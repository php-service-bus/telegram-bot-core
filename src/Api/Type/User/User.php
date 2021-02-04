<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 0);

namespace ServiceBus\TelegramBot\Api\Type\User;

/**
 * This object represents a Telegram user or bot.
 *
 * @see https://core.telegram.org/bots/api#user
 *
 * @psalm-immutable
 */
final class User
{
    /**
     * Unique identifier for this user or bot.
     *
     * @psalm-readonly
     *
     * @var UserId
     */
    public $id;

    /**
     * True, if this user is a bot.
     *
     * @psalm-readonly
     *
     * @var bool
     */
    public $isBot;

    /**
     * User‘s or bot’s first name.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $firstName;

    /**
     * Optional. User‘s or bot’s last name.
     *
     * @psalm-readonly
     *
     * @var string|null
     */
    public $lastName;

    /**
     * Optional. User‘s or bot’s username.
     *
     * @psalm-readonly
     *
     * @var string|null
     */
    public $username;

    /**
     * Optional. IETF language tag of the user's language.
     *
     * @psalm-readonly
     *
     * @see https://en.wikipedia.org/wiki/IETF_language_tag
     *
     * @var string|null
     */
    public $languageCode;
}
