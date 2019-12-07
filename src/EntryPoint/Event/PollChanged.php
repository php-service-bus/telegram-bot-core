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

use ServiceBus\TelegramBot\Api\Type\Poll\Poll;
use ServiceBus\TelegramBot\Api\Type\Update;

/**
 * Changed (create/close/vote) poll information.
 *
 * @psalm-readonly
 */
final class PollChanged implements TelegramEvent
{
    /**
     * @var Poll
     */
    public $pollInfo;

    /**
     * {@inheritdoc}
     */
    public static function supports(Update $update): bool
    {
        return null !== $update->poll;
    }

    /**
     * {@inheritdoc}
     */
    public static function fromUpdate(Update $update): TelegramEvent
    {
        if (null !== $update->poll)
        {
            return new self($update->poll);
        }

        throw new \LogicException('Incorrect update passed');
    }

    /**
     * {@inheritdoc}
     *
     * @return Poll
     */
    public function payload(): object
    {
        return $this->pollInfo;
    }

    /**
     * @param Poll $pollInfo
     */
    private function __construct(Poll $pollInfo)
    {
        $this->pollInfo = $pollInfo;
    }
}
