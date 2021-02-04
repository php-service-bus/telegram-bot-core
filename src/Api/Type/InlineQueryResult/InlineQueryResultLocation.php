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
use ServiceBus\TelegramBot\Api\Type\Location\Location;

/**
 * Represents a location on a map. By default, the location will be sent by the user. Alternatively, you can use
 * input_message_content to send a message with the specified content instead of the location.
 *
 * @see https://core.telegram.org/bots/api#inlinequeryresultlocation
 *
 * @psalm-immutable
 */
final class InlineQueryResultLocation implements InlineQueryResult
{
    /**
     * Type of the result, must be location.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $type = 'location';

    /**
     * Unique identifier for this result, 1-64 Bytes.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $id;

    /**
     * Coordinates.
     *
     * @psalm-readonly
     *
     * @var Location
     */
    public $coordinates;

    /**
     * Location title.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $title;

    /**
     * Optional. Period in seconds for which the location can be updated, should be between 60 and 86400.
     *
     * @psalm-readonly
     *
     * @var int|null
     */
    public $livePeriod;

    /**
     * Optional. Inline keyboard attached to the message.
     *
     * @psalm-readonly
     *
     * @var InlineKeyboardMarkup|null
     */
    public $replyMarkup;

    /**
     * Optional. Content of the message to be sent instead of the location.
     *
     * @psalm-readonly
     *
     * @var InputMessageContent|null
     */
    public $inputMessageContent;

    /**
     * Optional. Url of the thumbnail for the result.
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
