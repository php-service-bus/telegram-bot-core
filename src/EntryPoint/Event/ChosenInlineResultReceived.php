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

use ServiceBus\TelegramBot\Api\Type\InlineQuery\ChosenInlineResult;
use ServiceBus\TelegramBot\Api\Type\Update;

/**
 * Received result of an inline query that was chosen by the user and sent to their chat partner.
 */
final class ChosenInlineResultReceived implements TelegramEvent
{
    /**
     * @var ChosenInlineResult
     */
    private $chosenInlineResult;

    /**
     * {@inheritdoc}
     */
    public static function supports(Update $update): bool
    {
        return null !== $update->chosenInlineResult;
    }

    /**
     * {@inheritdoc}
     */
    public static function fromUpdate(Update $update): TelegramEvent
    {
        if (null !== $update->chosenInlineResult)
        {
            return new self($update->chosenInlineResult);
        }

        throw new \LogicException('Incorrect update passed');
    }

    /**
     * {@inheritdoc}
     *
     * @return ChosenInlineResult
     */
    public function payload(): object
    {
        return $this->chosenInlineResult;
    }

    /**
     * @param ChosenInlineResult $chosenInlineResult
     */
    private function __construct(ChosenInlineResult $chosenInlineResult)
    {
        $this->chosenInlineResult = $chosenInlineResult;
    }
}
