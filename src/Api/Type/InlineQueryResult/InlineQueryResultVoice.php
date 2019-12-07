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
 * Represents a link to a voice recording in an .ogg container encoded with OPUS. By default, this voice recording will
 * be sent by the user. Alternatively, you can use input_message_content to send a message with the specified content
 * instead of the the voice message.
 *
 * @see https://core.telegram.org/bots/api#inlinequeryresultvoice
 *
 * @psalm-readonly
 */
final class InlineQueryResultVoice implements InlineQueryResult
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
     * A valid URL for the voice recording.
     *
     * @var string
     */
    public $voiceUrl;

    /**
     * Recording title.
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
     * Optional. Recording duration in seconds.
     *
     * @var int|null
     */
    public $voiceDuration;

    /**
     * Optional. Inline keyboard attached to the message.
     *
     * @var InlineKeyboardMarkup|null
     */
    public $replyMarkup;

    /**
     * Optional. Content of the message to be sent instead of the voice recording.
     *
     * @var InputMessageContent|null
     */
    public $inputMessageContent;
}
