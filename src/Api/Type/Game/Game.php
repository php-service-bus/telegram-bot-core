<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 0);

namespace ServiceBus\TelegramBot\Api\Type\Game;

use ServiceBus\TelegramBot\Api\Type\Animation\Animation;
use ServiceBus\TelegramBot\Api\Type\Message\MessageEntity;
use ServiceBus\TelegramBot\Api\Type\Photo\PhotoSize;

/**
 * Represents a game. Use BotFather to create and edit games, their short names will act as unique identifiers.
 *
 * @see https://core.telegram.org/bots/api#game
 *
 * @psalm-immutable
 */
final class Game
{
    /**
     * Title of the game.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $title;

    /**
     * Description of the game.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $description;

    /**
     * Photo that will be displayed in the game message in chats.
     *
     * @psalm-readonly
     *
     * @var PhotoSize[]
     */
    public $photo = [];

    /**
     * Optional. Brief description of the game or high scores included in the game message. Can be automatically edited
     * to include current high scores for the game when the bot calls setGameScore, or manually edited using
     * editMessageText. 0-4096 characters.
     *
     * @psalm-readonly
     *
     * @see https://core.telegram.org/bots/api#setgamescore
     * @see https://core.telegram.org/bots/api#editmessagetext
     *
     * @var string|null
     */
    public $text;

    /**
     * Optional. Special entities that appear in text, such as usernames, URLs, bot commands, etc.
     *
     * @psalm-readonly
     *
     * @var MessageEntity[]
     */
    public $textEntities = [];

    /**
     * Optional. Animation that will be displayed in the game message in chats. Upload via BotFather.
     *
     * @psalm-readonly
     *
     * @var Animation|null
     */
    public $animation;
}
