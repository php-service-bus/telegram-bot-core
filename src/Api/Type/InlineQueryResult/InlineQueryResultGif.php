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
 * Represents a link to an animated GIF file. By default, this animated GIF file will be sent by the user with optional
 * caption. Alternatively, you can use input_message_content to send a message with the specified content instead of
 * the animation.
 *
 * @see https://core.telegram.org/bots/api#inlinequeryresultgif
 *
 * @property-read string                    $type
 * @property-read string                    $id
 * @property-read string                    $gifUrl
 * @property-read int|null                  $gifWidth
 * @property-read int|null                  $gifHeight
 * @property-read int|null                  $gifDuration
 * @property-read string                    $thumbUrl
 * @property-read string|null               $title
 * @property-read string|null               $caption
 * @property-read ParseMode|null            $parseMode
 * @property-read InlineKeyboardMarkup|null $replyMarkup
 * @property-read InputMessageContent|null  $inputMessageContent
 */
final class InlineQueryResultGif implements InlineQueryResult
{
    /**
     * Type of the result, must be gif.
     *
     * @var string
     */
    public $type = 'gif';

    /**
     * Unique identifier for this result, 1-64 bytes.
     *
     * @var string
     */
    public $id;

    /**
     * A valid URL for the GIF file. File size must not exceed 1MB.
     *
     * @var string
     */
    public $gifUrl;

    /**
     * Optional. Width of the GIF.
     *
     * @var int|null
     */
    public $gifWidth;

    /**
     * Optional. Height of the GIF.
     *
     * @var int|null
     */
    public $gifHeight;

    /**
     * Optional. Duration of the GIF.
     *
     * @var int|null
     */
    public $gifDuration;

    /**
     * URL of the static thumbnail for the result (jpeg or gif).
     *
     * @var string
     */
    public $thumbUrl;

    /**
     * Optional. Title for the result.
     *
     * @var string|null
     */
    public $title;

    /**
     * Optional. Caption of the GIF file to be sent, 0-1024 characters.
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
     * Optional. Content of the message to be sent instead of the GIF animation.
     *
     * @var InputMessageContent|null
     */
    public $inputMessageContent;
}
