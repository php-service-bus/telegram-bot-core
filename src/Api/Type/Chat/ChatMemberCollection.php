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
 * Chat members collection.
 *
 * @psalm-immutable
 */
final class ChatMemberCollection implements \IteratorAggregate
{
    /**
     * Members collection.
     *
     * @psalm-readonly
     *
     * @var ChatMember[]
     */
    public $list;

    public function getIterator(): \Generator
    {
        yield from $this->list;
    }
}
