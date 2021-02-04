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
 * Represents a link to a page containing an embedded video player or a video file. By default, this video file will be
 * sent by the user with an optional caption. Alternatively, you can use input_message_content to send a message with
 * the specified content instead of the video.
 *
 * @see https://core.telegram.org/bots/api#inlinequeryresultvideo
 *
 * @psalm-immutable
 */
final class InlineQueryResultVideo implements InlineQueryResult
{
    /**
     * Type of the result, must be video.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $type = 'video';

    /**
     * Unique identifier for this result, 1-64 bytes.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $id;

    /**
     * A valid URL for the embedded video player or video file.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $videoUrl;

    /**
     * Mime type of the content of video url, “text/html” or “video/mp4”.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $mimeType;

    /**
     * URL of the thumbnail (jpeg only) for the video.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $thumbUrl;

    /**
     * Title for the result.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $title;

    /**
     * Optional. Caption of the video to be sent, 0-1024 characters.
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
     * Optional. Video width.
     *
     * @psalm-readonly
     *
     * @var int|null
     */
    public $videoWidth;

    /**
     * Optional. Video height.
     *
     * @psalm-readonly
     *
     * @var int|null
     */
    public $videoHeight;

    /**
     * Optional. Video duration in seconds.
     *
     * @psalm-readonly
     *
     * @var int|null
     */
    public $videoDuration;

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
     * Optional. Content of the message to be sent instead of the video. This field is required if
     * InlineQueryResultVideo is used to send an HTML-page as a result (e.g., a YouTube video).
     *
     * @psalm-readonly
     *
     * @var InputMessageContent|null
     */
    public $inputMessageContent;
}
