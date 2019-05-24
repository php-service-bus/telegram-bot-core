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
 * New channel post received.
 */
final class ChannelPostReceived implements TelegramEvent
{
    /**
     * @var Message
     */
    private $channelPost;

    /**
     * {@inheritdoc}
     */
    public static function supports(Update $update): bool
    {
        return null !== $update->channelPost;
    }

    /**
     * {@inheritdoc}
     */
    public static function fromUpdate(Update $update): TelegramEvent
    {
        if (null !== $update->channelPost)
        {
            return new self($update->channelPost);
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
        return $this->channelPost;
    }

    /**
     * @param Message $channelPost
     */
    private function __construct(Message $channelPost)
    {
        $this->channelPost = $channelPost;
    }
}
