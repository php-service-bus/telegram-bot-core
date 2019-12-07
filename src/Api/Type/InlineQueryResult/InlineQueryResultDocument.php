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
 * Represents a link to a file. By default, this file will be sent by the user with an optional caption. Alternatively,
 * you can use input_message_content to send a message with the specified content instead of the file. Currently, only
 * .PDF and .ZIP files can be sent using this method.
 *
 * @see https://core.telegram.org/bots/api#inlinequeryresultdocument
 *
 * @psalm-readonly
 */
final class InlineQueryResultDocument implements InlineQueryResult
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
     * A valid URL for the file.
     *
     * @var string
     */
    public $documentUrl;

    /**
     * Mime type of the content of the file, either “application/pdf” or “application/zip”.
     *
     * @var string
     */
    public $mimeType;

    /**
     * Optional. Short description of the result.
     *
     * @var string|null
     */
    public $description;

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

    /**
     * Optional. URL of the thumbnail (jpeg only) for the file.
     *
     * @var string|null
     */
    public $thumbUrl;

    /**
     * Optional. Thumbnail width.
     *
     * @var int|null
     */
    public $thumbWidth;

    /**
     * Optional. Thumbnail height.
     *
     * @var int|null
     */
    public $thumbHeight;
}
