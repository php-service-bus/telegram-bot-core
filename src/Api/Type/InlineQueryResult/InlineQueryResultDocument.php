<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 0);

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
 * @psalm-immutable
 */
final class InlineQueryResultDocument implements InlineQueryResult
{
    /**
     * Type of the result, must be document.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $type = 'document';

    /**
     * Unique identifier for this result, 1-64 bytes.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $id;

    /**
     * Title for the result.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $title;

    /**
     * Optional. Caption of the document to be sent, 0-1024 characters.
     *
     * @psalm-readonly
     *
     * @var string|null
     */
    public $caption;

    /**
     * Optional. Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs
     * in the media caption.
     *
     * @psalm-readonly
     *
     * @var ParseMode|null
     */
    public $parseMode;

    /**
     * A valid URL for the file.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $documentUrl;

    /**
     * Mime type of the content of the file, either “application/pdf” or “application/zip”.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $mimeType;

    /**
     * Optional. Short description of the result.
     *
     * @psalm-readonly
     *
     * @var string|null
     */
    public $description;

    /**
     * Optional. Inline keyboard attached to the message.
     *
     * @psalm-readonly
     *
     * @var InlineKeyboardMarkup|null
     */
    public $replyMarkup;

    /**
     * Optional. Content of the message to be sent instead of the file.
     *
     * @psalm-readonly
     *
     * @var InputMessageContent|null
     */
    public $inputMessageContent;

    /**
     * Optional. URL of the thumbnail (jpeg only) for the file.
     *
     * @psalm-readonly
     *
     * @var string|null
     */
    public $thumbUrl;

    /**
     * Optional. Thumbnail width.
     *
     * @psalm-readonly
     *
     * @var int|null
     */
    public $thumbWidth;

    /**
     * Optional. Thumbnail height.
     *
     * @psalm-readonly
     *
     * @var int|null
     */
    public $thumbHeight;
}
