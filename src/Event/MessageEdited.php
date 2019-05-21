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
 * Received edited version of the message in the chat.
 */
final class MessageEdited implements TelegramEvent
{
    /**
     * @var TelegramBot
     */
    private $bot;

    /**
     * @var Message
     */
    private $message;

    /**
     * @param TelegramBot $bot
     * @param Message     $message
     *
     * @return self
     */
    public static function create(TelegramBot $bot, Message $message): self
    {
        $self = new self();

        $self->bot     = $bot;
        $self->message = $message;

        return $self;
    }

    /**
     * {@inheritdoc}
     *
     * @return Message
     */
    public function payload(): object
    {
        return $this->message;
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
