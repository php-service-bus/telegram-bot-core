<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\EntryPoint\Event;

use ServiceBus\TelegramBot\Api\Type\InlineQuery\InlineQuery;
use ServiceBus\TelegramBot\Api\Type\Update;

/**
 * Received new inline query.
 */
final class InlineQueryReceived implements TelegramEvent
{
    /**
     * @var InlineQuery
     */
    private $query;

    /**
     * {@inheritdoc}
     */
    public static function supports(Update $update): bool
    {
        return null !== $update->inlineQuery;
    }

    /**
     * {@inheritdoc}
     */
    public static function fromUpdate(Update $update): TelegramEvent
    {
        if (null !== $update->inlineQuery)
        {
            return new self($update->inlineQuery);
        }

        throw new \LogicException('Incorrect update passed');
    }

    /**
     * {@inheritdoc}
     *
     * @return InlineQuery
     */
    public function payload(): object
    {
        return $this->query;
    }

    /**
     * @param InlineQuery $query
     */
    private function __construct(InlineQuery $query)
    {
        $this->query = $query;
    }
}
