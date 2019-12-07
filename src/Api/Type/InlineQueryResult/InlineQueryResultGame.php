<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Type\InlineQueryResult;

use ServiceBus\TelegramBot\Api\Type\Keyboard\InlineKeyboardMarkup;

/**
 * Represents a Game.
 *
 * @see https://core.telegram.org/bots/api#inlinequeryresultgame
 * @see https://core.telegram.org/bots/api#games
 *
 * @psalm-readonly
 */
final class InlineQueryResultGame implements InlineQueryResult
{
    /**
     * Type of the result, must be game.
     *
     * @var string
     */
    public $type = 'game';

    /**
     * Unique identifier for this result, 1-64 bytes.
     *
     * @var string
     */
    public $id;

    /**
     * Short name of the game.
     *
     * @var string
     */
    public $gameShortName;

    /**
     * Optional. Inline keyboard attached to the message.
     *
     * @var InlineKeyboardMarkup|null
     */
    public $replyMarkup;
}
