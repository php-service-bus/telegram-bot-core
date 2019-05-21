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
use ServiceBus\TelegramBot\Api\Type\ParseMode;

/**
 * Represents a link to a voice message stored on the Telegram servers. By default, this voice message will be sent by
 * the user. Alternatively, you can use input_message_content to send a message with the specified content instead of
 * the voice message.
 *
 * @see https://core.telegram.org/bots/api#inlinequeryresultcachedvoice
 *
 * @property-read string                    $type
 * @property-read string                    $id
 * @property-read string                    $voiceFileId
 * @property-read string                    $title
 * @property-read string|null               $caption
 * @property-read ParseMode|null            $parseMode
 * @property-read InlineKeyboardMarkup|null $replyMarkup
 * @property-read InputMessageContent|null  $inputMessageContent
 */
final class InlineQueryResultCachedVoice implements InlineQueryResult
{
    /**
     * Type of the result, must be voice.
     *
     * @var string
     */
    public $type = 'voice';

    /**
     * Unique identifier for this result, 1-64 bytes.
     *
     * @var string
     */
    public $id;

    /**
     * A valid file identifier for the voice message.
     *
     * @var string
     */
    public $voiceFileId;

    /**
     * Voice message title.
     *
     * @var string
     */
    public $title;

    /**
     * Optional. Caption, 0-1024 characters.
     *
     * @var string|null
     */
    public $caption;

    /**
     * Optional. Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs
     * in the media caption.
     *
     * @var ParseMode|null
     */
    public $parseMode;

    /**
     * Optional. Inline keyboard attached to the message.
     *
     * @var InlineKeyboardMarkup|null
     */
    public $replyMarkup;

    /**
     * Optional. Content of the message to be sent instead of the voice message.
     *
     * @var InputMessageContent|null
     */
    public $inputMessageContent;
}
