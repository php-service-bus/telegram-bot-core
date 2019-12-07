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
 * Users.
 *
 * @psalm-readonly
 */
final class UserCollection implements \IteratorAggregate
{
    /**
     * Members collection.
     *
     * @var User[]
     */
    public $list = [];

    /**
     * @param User[] $list
     *
     * @return self
     */
    public static function create(array $list): self
    {
        return new self($list);
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator(): \Generator
    {
        return yield from $this->list;
    }

    /**
     * @param User[] $list
     */
    private function __construct(array $list)
    {
        $this->list = $list;
    }
}
