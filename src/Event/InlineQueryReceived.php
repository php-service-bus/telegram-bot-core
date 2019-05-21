<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Event;

use ServiceBus\TelegramBot\Api\Type\InlineQuery\InlineQuery;
use ServiceBus\TelegramBot\Bot\TelegramBot;

/**
 * Received new inline query.
 */
final class InlineQueryReceived implements TelegramEvent
{
    /**
     * @var TelegramBot
     */
    private $bot;

    /**
     * @var InlineQuery
     */
    private $query;

    /**
     * @param TelegramBot $bot
     * @param InlineQuery $query
     *
     * @return self
     */
    public static function create(TelegramBot $bot, InlineQuery $query): self
    {
        $self = new self();

        $self->bot   = $bot;
        $self->query = $query;

        return $self;
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
     * {@inheritdoc}
     */
    public function bot(): TelegramBot
    {
        return $this->bot;
    }

    private function __construct()
    {
    }
}
