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

/**
 * Represents a contact with a phone number. By default, this contact will be sent by the user. Alternatively, you can
 * use input_message_content to send a message with the specified content instead of the contact.
 *
 * @see https://core.telegram.org/bots/api#inlinequeryresultcontact
 *
 * @property-read string                    $type
 * @property-read string                    $id
 * @property-read string                    $phoneNumber
 * @property-read string                    $firstName
 * @property-read string|null               $lastName
 * @property-read string|null               $vcard
 * @property-read InlineKeyboardMarkup|null $replyMarkup
 * @property-read InputMessageContent|null  $inputMessageContent
 * @property-read string|null               $thumbUrl
 * @property-read int|null                  $thumbWidth
 * @property-read int|null                  $thumbHeight
 */
final class InlineQueryResultContact implements InlineQueryResult
{
    /**
     * Type of the result, must be contact.
     *
     * @var string
     */
    public $type = 'contact';

    /**
     * Unique identifier for this result, 1-64 Bytes.
     *
     * @var string
     */
    public $id;

    /**
     * Contact's phone number.
     *
     * @var string
     */
    public $phoneNumber;

    /**
     * Contact's first name.
     *
     * @var string
     */
    public $firstName;

    /**
     * Optional. Contact's last name.
     *
     * @var string|null
     */
    public $lastName;

    /**
     * Optional. Additional data about the contact in the form of a vCard, 0-2048 bytes.
     *
     * @var string|null
     */
    public $vcard;

    /**
     * Optional. Inline keyboard attached to the message.
     *
     * @var InlineKeyboardMarkup|null
     */
    public $replyMarkup;

    /**
     * Optional. Content of the message to be sent instead of the contact.
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
