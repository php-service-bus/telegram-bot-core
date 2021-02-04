<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Type\InlineQueryResult;

use ServiceBus\TelegramBot\Api\Type\InputMessageContent\InputMessageContent;
use ServiceBus\TelegramBot\Api\Type\Keyboard\InlineKeyboardMarkup;
use ServiceBus\TelegramBot\Api\Type\ParseMode;

/**
 * Represents a link to a video animation (H.264/MPEG-4 AVC video without sound) stored on the Telegram servers. By
 * default, this animated MPEG-4 file will be sent by the user with an optional caption. Alternatively, you can use
 * input_message_content to send a message with the specified content instead of the animation.
 *
 * @see https://core.telegram.org/bots/api#inlinequeryresultcachedmpeg4gif
 *
 * @psalm-immutable
 */
final class InlineQueryResultCachedMpeg4Gif implements InlineQueryResult
{
    /**
     * Type of the result, must be mpeg4_gif.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $type = 'mpeg4_gif';

    /**
     * Unique identifier for this result, 1-64 bytes.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $id;

    /**
     * A valid file identifier for the MP4 file.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $mpeg4FileId;

    /**
     * Optional. Title for the result.
     *
     * @psalm-readonly
     *
     * @var string|null
     */
    public $title;

    /**
     * Optional. Caption of the MPEG-4 file to be sent, 0-1024 characters.
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
     * Optional. Inline keyboard attached to the message.
     *
     * @psalm-readonly
     *
     * @var InlineKeyboardMarkup|null
     */
    public $replyMarkup;

    /**
     * Optional. Content of the message to be sent instead of the video animation.
     *
     * @psalm-readonly
     *
     * @var InputMessageContent|null
     */
    public $inputMessageContent;
}
