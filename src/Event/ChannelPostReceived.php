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

use ServiceBus\TelegramBot\Api\Type\Message\Message;
use ServiceBus\TelegramBot\Bot\TelegramBot;

/**
 * New channel post received.
 */
final class ChannelPostReceived implements TelegramEvent
{
    /**
     * @var TelegramBot
     */
    private $bot;

    /**
     * @var Message
     */
    private $channelPost;

    /**
     * @param TelegramBot $bot
     * @param Message     $channelPost
     *
     * @return self
     */
    public static function create(TelegramBot $bot, Message $channelPost): self
    {
        $self = new self();

        $self->bot         = $bot;
        $self->channelPost = $channelPost;

        return $self;
    }

    /**
     * {@inheritdoc}
     *
     * @return Message
     */
    public function payload(): object
    {
        return $this->channelPost;
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
