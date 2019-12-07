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
 * Represents a link to a page containing an embedded video player or a video file. By default, this video file will be
 * sent by the user with an optional caption. Alternatively, you can use input_message_content to send a message with
 * the specified content instead of the video.
 *
 * @see https://core.telegram.org/bots/api#inlinequeryresultvideo
 *
 * @psalm-readonly
 */
final class InlineQueryResultVideo implements InlineQueryResult
{
    /**
     * Type of the result, must be video.
     *
     * @var string
     */
    public $type = 'video';

    /**
     * Unique identifier for this result, 1-64 bytes.
     *
     * @var string
     */
    public $id;

    /**
     * A valid URL for the embedded video player or video file.
     *
     * @var string
     */
    public $videoUrl;

    /**
     * Mime type of the content of video url, “text/html” or “video/mp4”.
     *
     * @var string
     */
    public $mimeType;

    /**
     * URL of the thumbnail (jpeg only) for the video.
     *
     * @var string
     */
    public $thumbUrl;

    /**
     * Title for the result.
     *
     * @var string
     */
    public $title;

    /**
     * Optional. Caption of the video to be sent, 0-1024 characters.
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
     * Optional. Video width.
     *
     * @var int|null
     */
    public $videoWidth;

    /**
     * Optional. Video height.
     *
     * @var int|null
     */
    public $videoHeight;

    /**
     * Optional. Video duration in seconds.
     *
     * @var int|null
     */
    public $videoDuration;

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
     * Optional. Content of the message to be sent instead of the video. This field is required if
     * InlineQueryResultVideo is used to send an HTML-page as a result (e.g., a YouTube video).
     *
     * @var InputMessageContent|null
     */
    public $inputMessageContent;
}
