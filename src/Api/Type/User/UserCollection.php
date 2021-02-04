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
 * Users.
 *
 * @psalm-immutable
 */
final class UserCollection implements \IteratorAggregate
{
    /**
     * Members collection.
     *
     * @psalm-readonly
     *
     * @var User[]
     */
    public $list = [];

    /**
     * @param User[] $list
     */
    public static function create(array $list): self
    {
        return new self($list);
    }

    public function getIterator(): \Generator
    {
        yield from $this->list;
    }

    /**
     * @param User[] $list
     */
    private function __construct(array $list)
    {
        $this->list = $list;
    }
}
