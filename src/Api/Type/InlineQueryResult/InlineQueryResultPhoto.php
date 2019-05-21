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
 * Represents a link to a photo. By default, this photo will be sent by the user with optional caption. Alternatively,
 * you can use input_message_content to send a message with the specified content instead of the photo.
 *
 * @see https://core.telegram.org/bots/api#inlinequeryresultphoto
 *
 * @property-read string                    $type
 * @property-read string                    $id
 * @property-read string                    $photoUrl
 * @property-read string                    $thumbUrl
 * @property-read int|null                  $photoWidth
 * @property-read int|null                  $photoHeight
 * @property-read string|null               $title
 * @property-read string|null               $description
 * @property-read string|null               $caption
 * @property-read ParseMode|null            $parseMode
 * @property-read InlineKeyboardMarkup|null $replyMarkup
 * @property-read InputMessageContent|null  $inputMessageContent
 */
final class InlineQueryResultPhoto implements InlineQueryResult
{
    /**
     * Type of the result, must be photo.
     *
     * @var string
     */
    public $type = 'photo';

    /**
     * Unique identifier for this result, 1-64 bytes.
     *
     * @var string
     */
    public $id;

    /**
     * A valid URL of the photo. Photo must be in jpeg format. Photo size must not exceed 5MB.
     *
     * @var string
     */
    public $photoUrl;

    /**
     * URL of the thumbnail for the photo.
     *
     * @var string
     */
    public $thumbUrl;

    /**
     * Optional. Width of the photo.
     *
     * @var int|null
     */
    public $photoWidth;

    /**
     * Optional. Height of the photo.
     *
     * @var int|null
     */
    public $photoHeight;

    /**
     * Optional. Title for the result.
     *
     * @var string|null
     */
    public $title;

    /**
     * Optional. Short description of the result.
     *
     * @var string|null
     */
    public $description;

    /**
     * Optional. Caption of the photo to be sent, 0-1024 characters.
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
     * Optional. Content of the message to be sent instead of the photo.
     *
     * @var InputMessageContent|null
     */
    public $inputMessageContent;
}
