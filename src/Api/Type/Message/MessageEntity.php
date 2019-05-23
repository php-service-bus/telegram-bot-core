<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Type\Message;

use ServiceBus\TelegramBot\Api\Type\User\User;

/**
 * Represents one special entity in a text message. For example, hashtags, usernames, URLs, etc.
 *
 * @see https://core.telegram.org/bots/api#messageentity
 *
 * @property-read MessageEntityType $type
 * @property-read int               $offset
 * @property-read int               $length
 * @property-read string|null       $url
 * @property-read User|null         $user
 */
final class MessageEntity
{
    /**
     * Type of the entity.
     *
     * @var MessageEntityType
     */
    public $type;

    /**
     * Offset in UTF-16 code units to the start of the entity.
     *
     * @var int
     */
    public $offset;

    /**
     * Length of the entity in UTF-16 code units.
     *
     * @var int
     */
    public $length;

    /**
     * Optional. For “text_link” only, url that will be opened after user taps on the text.
     *
     * @var string|null
     */
    public $url;

    /**
     * Optional. For “text_mention” only, the mentioned user.
     *
     * @var User|null
     */
    public $user;

    /**
     * @return bool
     */
    public function isCommand(): bool
    {
        return $this->type->equals(MessageEntityType::botCommand());
    }
}
