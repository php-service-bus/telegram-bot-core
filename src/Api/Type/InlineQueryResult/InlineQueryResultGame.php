<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types=0);

namespace ServiceBus\TelegramBot\Api\Type\InlineQueryResult;

use ServiceBus\TelegramBot\Api\Type\Keyboard\InlineKeyboardMarkup;

/**
 * Represents a Game.
 *
 * @see https://core.telegram.org/bots/api#inlinequeryresultgame
 * @see https://core.telegram.org/bots/api#games
 *
 * @psalm-immutable
 */
final class InlineQueryResultGame implements InlineQueryResult
{
    /**
     * Type of the result, must be game.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $type = 'game';

    /**
     * Unique identifier for this result, 1-64 bytes.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $id;

    /**
     * Short name of the game.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $gameShortName;

    /**
     * Optional. Inline keyboard attached to the message.
     *
     * @psalm-readonly
     *
     * @var InlineKeyboardMarkup|null
     */
    public $replyMarkup;
}
