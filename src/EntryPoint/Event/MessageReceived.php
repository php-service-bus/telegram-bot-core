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

use ServiceBus\TelegramBot\Api\Type\Message\Message;
use ServiceBus\TelegramBot\Api\Type\Update;

/**
 * New message received.
 *
 * @psalm-readonly
 */
final class MessageReceived implements TelegramEvent
{
    /**
     * @var Message
     */
    public $message;

    /**
     * {@inheritdoc}
     */
    public static function supports(Update $update): bool
    {
        return null !== $update->message;
    }

    /**
     * {@inheritdoc}
     */
    public static function fromUpdate(Update $update): TelegramEvent
    {
        if (null !== $update->message)
        {
            return new self($update->message);
        }

        throw new \LogicException('Incorrect update passed');
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
     * @param Message $message
     */
    private function __construct(Message $message)
    {
        $this->message = $message;
    }
}
