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
 * Represents a venue. By default, the venue will be sent by the user. Alternatively, you can use input_message_content
 * to send a message with the specified content instead of the venue.
 *
 * @see https://core.telegram.org/bots/api#inlinequeryresultvenue
 *
 * @property-read string                    $type
 * @property-read string                    $id
 * @property-read Location                  $coordinates
 * @property-read string                    $title
 * @property-read string                    $address
 * @property-read string|null               $foursquareId
 * @property-read string|null               $foursquareType
 * @property-read InlineKeyboardMarkup|null $replyMarkup
 * @property-read InputMessageContent|null  $inputMessageContent
 * @property-read string|null               $thumbUrl
 * @property-read int|null                  $thumbWidth
 * @property-read int|null                  $thumbHeight
 */
final class InlineQueryResultVenue implements InlineQueryResult
{
    /**
     * Type of the result, must be venue.
     *
     * @var string
     */
    public $type = 'venue';

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
     * Title of the venue.
     *
     * @var string
     */
    public $title;

    /**
     * Address of the venue.
     *
     * @var string
     */
    public $address;

    /**
     * Optional. Foursquare identifier of the venue if known.
     *
     * @var string|null
     */
    public $foursquareId;

    /**
     * Optional. Foursquare type of the venue, if known. (For example, “arts_entertainment/default”,
     * “arts_entertainment/aquarium” or “food/icecream”.).
     *
     * @var string|null
     */
    public $foursquareType;

    /**
     * Optional. Inline keyboard attached to the message.
     *
     * @var InlineKeyboardMarkup|null
     */
    public $replyMarkup;

    /**
     * Optional. Content of the message to be sent instead of the venue.
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
