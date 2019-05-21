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

use ServiceBus\TelegramBot\Api\Type\InlineQuery\ChosenInlineResult;
use ServiceBus\TelegramBot\Bot\TelegramBot;

/**
 * Received result of an inline query that was chosen by the user and sent to their chat partner.
 */
final class ChosenInlineResultReceived implements TelegramEvent
{
    /**
     * @var TelegramBot
     */
    private $bot;

    /**
     * @var ChosenInlineResult
     */
    private $chosenInlineResult;

    /**
     * @param TelegramBot        $bot
     * @param ChosenInlineResult $chosenInlineResult
     *
     * @return self
     */
    public static function create(TelegramBot $bot, ChosenInlineResult $chosenInlineResult): self
    {
        return new self($bot, $chosenInlineResult);
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
     * {@inheritdoc}
     */
    public function bot(): TelegramBot
    {
        return $this->bot;
    }

    /**
     * @param TelegramBot        $bot
     * @param ChosenInlineResult $chosenInlineResult
     */
    private function __construct(TelegramBot $bot, ChosenInlineResult $chosenInlineResult)
    {
        $this->bot                = $bot;
        $this->chosenInlineResult = $chosenInlineResult;
    }
}
