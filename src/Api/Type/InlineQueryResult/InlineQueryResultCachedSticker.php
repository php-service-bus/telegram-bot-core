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

use ServiceBus\TelegramBot\Api\Type\InputMessageContent\InputMessageContent;
use ServiceBus\TelegramBot\Api\Type\Keyboard\InlineKeyboardMarkup;

/**
 * Represents a link to a sticker stored on the Telegram servers. By default, this sticker will be sent by the user.
 * Alternatively, you can use input_message_content to send a message with the specified content instead of the
 * sticker.
 *
 * @see https://core.telegram.org/bots/api#inlinequeryresultcachedsticker
 *
 * @psalm-readonly
 */
final class InlineQueryResultCachedSticker implements InlineQueryResult
{
    /**
     * Type of the result, must be sticker.
     *
     * @var string
     */
    public $type = 'sticker';

    /**
     * Unique identifier for this result, 1-64 bytes.
     *
     * @var string
     */
    public $id;

    /**
     * A valid file identifier of the sticker.
     *
     * @var string
     */
    public $stickerFileId;

    /**
     * Optional. Inline keyboard attached to the message.
     *
     * @var InlineKeyboardMarkup|null
     */
    public $replyMarkup;

    /**
     * Optional. Content of the message to be sent instead of the sticker.
     *
     * @var InputMessageContent|null
     */
    public $inputMessageContent;
}
