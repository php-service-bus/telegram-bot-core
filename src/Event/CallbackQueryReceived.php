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

use ServiceBus\TelegramBot\Api\Type\CallbackQuery;
use ServiceBus\TelegramBot\Bot\TelegramBot;

/**
 * Received callback query from a callback button in an inline keyboard.
 */
final class CallbackQueryReceived implements TelegramEvent
{
    /**
     * @var TelegramBot
     */
    private $bot;

    /**
     * @var CallbackQuery
     */
    private $callbackQuery;

    /**
     * @param TelegramBot   $bot
     * @param CallbackQuery $callbackQuery
     *
     * @return self
     */
    public static function create(TelegramBot $bot, CallbackQuery $callbackQuery): self
    {
        return new self($bot, $callbackQuery);
    }

    /**
     * {@inheritdoc}
     *
     * @return CallbackQuery
     */
    public function payload(): object
    {
        return $this->callbackQuery;
    }

    /**
     * {@inheritdoc}
     */
    public function bot(): TelegramBot
    {
        return $this->bot;
    }

    /**
     * @param TelegramBot   $bot
     * @param CallbackQuery $callbackQuery
     */
    private function __construct(TelegramBot $bot, CallbackQuery $callbackQuery)
    {
        $this->bot           = $bot;
        $this->callbackQuery = $callbackQuery;
    }
}
