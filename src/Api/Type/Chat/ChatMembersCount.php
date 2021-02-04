<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 0);

namespace ServiceBus\TelegramBot\Api\Type\Chat;

/**
 * @property-read int $value
 *
 * @psalm-immutable
 */
final class ChatMembersCount
{
    /**
     * Chat members count.
     *
     * @psalm-readonly
     *
     * @var int
     */
    public $value;
}
