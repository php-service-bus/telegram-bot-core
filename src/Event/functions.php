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

use ServiceBus\TelegramBot\Api\Type\Update;
use ServiceBus\TelegramBot\Bot\TelegramBot;

/**
 * @todo: Poll event
 *
 * @internal
 *
 * @param TelegramBot $bot
 * @param Update      $update
 *
 * @throws \LogicException
 *
 * @return TelegramEvent
 *
 */
function adapt(TelegramBot $bot, Update $update): TelegramEvent
{
    if (null !== $update->message)
    {
        return MessageReceived::create($bot, $update->message);
    }

    if (null !== $update->editedMessage)
    {
        return MessageEdited::create($bot, $update->editedMessage);
    }

    if (null !== $update->inlineQuery)
    {
        return InlineQueryReceived::create($bot, $update->inlineQuery);
    }

    if (null !== $update->callbackQuery)
    {
        return CallbackQueryReceived::create($bot, $update->callbackQuery);
    }

    if (null !== $update->channelPost)
    {
        return ChannelPostReceived::create($bot, $update->channelPost);
    }

    if (null !== $update->editedChannelPost)
    {
        return ChannelPostEdited::create($bot, $update->editedChannelPost);
    }

    if (null !== $update->chosenInlineResult)
    {
        return ChosenInlineResultReceived::create($bot, $update->chosenInlineResult);
    }

    if (null !== $update->preCheckoutQuery)
    {
        return PreCheckoutQueryReceived::create($bot, $update->preCheckoutQuery);
    }

    if (null !== $update->shippingQuery)
    {
        return ShippingQueryReceived::create($bot, $update->shippingQuery);
    }

    throw new \LogicException(\sprintf('Unsupported event received (update_id: %d)', $update->updateId));
}
