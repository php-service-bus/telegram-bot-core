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

use ServiceBus\TelegramBot\Api\Type\CallbackQuery;
use ServiceBus\TelegramBot\Api\Type\Update;

/**
 * Received callback query from a callback button in an inline keyboard.
 */
final class CallbackQueryReceived implements TelegramEvent
{
    /**
     * @var CallbackQuery
     */
    private $callbackQuery;

    /**
     * {@inheritdoc}
     */
    public static function supports(Update $update): bool
    {
        return null !== $update->callbackQuery;
    }

    /**
     * {@inheritdoc}
     */
    public static function fromUpdate(Update $update): TelegramEvent
    {
        if (null !== $update->callbackQuery)
        {
            return new self($update->callbackQuery);
        }

        throw new \LogicException('Incorrect update passed');
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
     * @param CallbackQuery $callbackQuery
     */
    private function __construct(CallbackQuery $callbackQuery)
    {
        $this->callbackQuery = $callbackQuery;
    }
}
