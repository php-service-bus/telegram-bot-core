<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Type\User;

/**
 * This object represents a Telegram user or bot.
 *
 * @see https://core.telegram.org/bots/api#user
 *
 * @psalm-readonly
 */
final class User
{
    /**
     * Unique identifier for this user or bot.
     *
     * @var UserId
     */
    public $id;

    /**
     * True, if this user is a bot.
     *
     * @var bool
     */
    public $isBot;

    /**
     * User‘s or bot’s first name.
     *
     * @var string
     */
    public $firstName;

    /**
     * Optional. User‘s or bot’s last name.
     *
     * @var string|null
     */
    public $lastName;

    /**
     * Optional. User‘s or bot’s username.
     *
     * @var string|null
     */
    public $username;

    /**
     * Optional. IETF language tag of the user's language.
     *
     * @see https://en.wikipedia.org/wiki/IETF_language_tag
     *
     * @var string|null
     */
    public $languageCode;
}
