<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Type\Chat;

/**
 * Chat members collection.
 */
final class ChatMemberCollection implements \IteratorAggregate
{
    /**
     * Members collection.
     *
     * @var ChatMember[]
     */
    public $list;

    /**
     * {@inheritdoc}
     */
    public function getIterator(): \Generator
    {
        return yield from $this->list;
    }
}
