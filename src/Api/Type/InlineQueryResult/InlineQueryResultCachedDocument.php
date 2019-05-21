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
 * Represents a link to a file stored on the Telegram servers. By default, this file will be sent by the user with an
 * optional caption. Alternatively, you can use input_message_content to send a message with the specified content
 * instead of the file.
 *
 * @see https://core.telegram.org/bots/api#inlinequeryresultcacheddocument
 *
 * @property-read string                    $type
 * @property-read string                    $id
 * @property-read string                    $title
 * @property-read string                    $documentFileId
 * @property-read string|null               $description
 * @property-read string|null               $caption
 * @property-read ParseMode|null            $parseMode
 * @property-read InlineKeyboardMarkup|null $replyMarkup
 * @property-read InputMessageContent|null  $inputMessageContent
 */
final class InlineQueryResultCachedDocument implements InlineQueryResult
{
    /**
     * Type of the result, must be document.
     *
     * @var string
     */
    public $type = 'document';

    /**
     * Unique identifier for this result, 1-64 bytes.
     *
     * @var string
     */
    public $id;

    /**
     * Title for the result.
     *
     * @var string
     */
    public $title;

    /**
     * A valid file identifier for the file.
     *
     * @var string
     */
    public $documentFileId;

    /**
     * Optional. Short description of the result.
     *
     * @var string|null
     */
    public $description;

    /**
     * Optional. Caption of the document to be sent, 0-1024 characters.
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
     * Optional. Content of the message to be sent instead of the file.
     *
     * @var InputMessageContent|null
     */
    public $inputMessageContent;
}
