<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Type;

/**
 * Updates collection.
 *
 * @see Update
 *
 * @psalm-readonly
 */
final class UpdateCollection implements \IteratorAggregate
{
    /**
     * List of updates.
     *
     * @var Update[]
     */
    public $list = [];

    /**
     * {@inheritdoc}
     */
    public function getIterator(): \Generator
    {
        yield from $this->list;
    }
}
