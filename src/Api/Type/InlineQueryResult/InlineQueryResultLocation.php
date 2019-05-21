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
use ServiceBus\TelegramBot\Api\Type\Location\Location;

/**
 * Represents a location on a map. By default, the location will be sent by the user. Alternatively, you can use
 * input_message_content to send a message with the specified content instead of the location.
 *
 * @see https://core.telegram.org/bots/api#inlinequeryresultlocation
 *
 * @property-read string                    $type
 * @property-read string                    $id
 * @property-read Location                  $coordinates
 * @property-read string                    $title
 * @property-read int|null                  $livePeriod
 * @property-read InlineKeyboardMarkup|null $replyMarkup
 * @property-read InputMessageContent|null  $inputMessageContent
 * @property-read string|null               $thumbUrl
 * @property-read int|null                  $thumbWidth
 * @property-read int|null                  $thumbHeight
 */
final class InlineQueryResultLocation implements InlineQueryResult
{
    /**
     * Type of the result, must be location.
     *
     * @var string
     */
    public $type = 'location';

    /**
     * Unique identifier for this result, 1-64 Bytes.
     *
     * @var string
     */
    public $id;

    /**
     * Coordinates.
     *
     * @var Location
     */
    public $coordinates;

    /**
     * Location title.
     *
     * @var string
     */
    public $title;

    /**
     * Optional. Period in seconds for which the location can be updated, should be between 60 and 86400.
     *
     * @var int|null
     */
    public $livePeriod;

    /**
     * Optional. Inline keyboard attached to the message.
     *
     * @var InlineKeyboardMarkup|null
     */
    public $replyMarkup;

    /**
     * Optional. Content of the message to be sent instead of the location.
     *
     * @var InputMessageContent|null
     */
    public $inputMessageContent;

    /**
     * Optional. Url of the thumbnail for the result.
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
