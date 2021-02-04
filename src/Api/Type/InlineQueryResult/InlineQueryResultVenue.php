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
use ServiceBus\TelegramBot\Api\Type\Location\Location;

/**
 * Represents a venue. By default, the venue will be sent by the user. Alternatively, you can use input_message_content
 * to send a message with the specified content instead of the venue.
 *
 * @see https://core.telegram.org/bots/api#inlinequeryresultvenue
 *
 * @psalm-immutable
 */
final class InlineQueryResultVenue implements InlineQueryResult
{
    /**
     * Type of the result, must be venue.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $type = 'venue';

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
     * Title of the venue.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $title;

    /**
     * Address of the venue.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $address;

    /**
     * Optional. Foursquare identifier of the venue if known.
     *
     * @psalm-readonly
     *
     * @var string|null
     */
    public $foursquareId;

    /**
     * Optional. Foursquare type of the venue, if known. (For example, “arts_entertainment/default”,
     * “arts_entertainment/aquarium” or “food/icecream”.).
     *
     * @psalm-readonly
     *
     * @var string|null
     */
    public $foursquareType;

    /**
     * Optional. Inline keyboard attached to the message.
     *
     * @psalm-readonly
     *
     * @var InlineKeyboardMarkup|null
     */
    public $replyMarkup;

    /**
     * Optional. Content of the message to be sent instead of the venue.
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
