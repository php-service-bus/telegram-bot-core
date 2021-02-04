<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
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
 */
final class MessageEntity
{
    /**
     * Type of the entity.
     *
     * @psalm-readonly
     *
     * @var MessageEntityType
     */
    public $type;

    /**
     * Offset in UTF-16 code units to the start of the entity.
     *
     * @psalm-readonly
     *
     * @var int
     */
    public $offset;

    /**
     * Length of the entity in UTF-16 code units.
     *
     * @psalm-readonly
     *
     * @var int
     */
    public $length;

    /**
     * Optional. For “text_link” only, url that will be opened after user taps on the text.
     *
     * @psalm-readonly
     *
     * @var string|null
     */
    public $url;

    /**
     * Optional. For “text_mention” only, the mentioned user.
     *
     * @psalm-readonly
     *
     * @var User|null
     */
    public $user;

    public function isCommand(): bool
    {
        return $this->type->equals(MessageEntityType::botCommand());
    }
}
