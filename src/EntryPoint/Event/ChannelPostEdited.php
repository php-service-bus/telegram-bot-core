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
 * Channel post edited.
 *
 * @psalm-readonly
 */
final class ChannelPostEdited implements TelegramEvent
{
    /**
     * @var Message
     */
    public $editedChannelPost;

    /**
     * {@inheritdoc}
     */
    public static function supports(Update $update): bool
    {
        return null !== $update->editedChannelPost;
    }

    /**
     * {@inheritdoc}
     */
    public static function fromUpdate(Update $update): TelegramEvent
    {
        if (null !== $update->editedChannelPost)
        {
            return new self($update->editedChannelPost);
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
        return $this->editedChannelPost;
    }

    /**
     * @param Message $editedChannelPost
     */
    private function __construct(Message $editedChannelPost)
    {
        $this->editedChannelPost = $editedChannelPost;
    }
}
