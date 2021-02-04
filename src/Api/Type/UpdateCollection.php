<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 0);

namespace ServiceBus\TelegramBot\Api\Type;

/**
 * Updates collection.
 *
 * @see Update
 *
 * @psalm-immutable
 */
final class UpdateCollection implements \IteratorAggregate
{
    /**
     * List of updates.
     *
     * @psalm-readonly
     *
     * @var Update[]
     */
    public $list = [];

    public function getIterator(): \Generator
    {
        yield from $this->list;
    }
}
