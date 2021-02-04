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

/**
 * Represents a contact with a phone number. By default, this contact will be sent by the user. Alternatively, you can
 * use input_message_content to send a message with the specified content instead of the contact.
 *
 * @see https://core.telegram.org/bots/api#inlinequeryresultcontact
 *
 * @psalm-immutable
 */
final class InlineQueryResultContact implements InlineQueryResult
{
    /**
     * Type of the result, must be contact.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $type = 'contact';

    /**
     * Unique identifier for this result, 1-64 Bytes.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $id;

    /**
     * Contact's phone number.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $phoneNumber;

    /**
     * Contact's first name.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $firstName;

    /**
     * Optional. Contact's last name.
     *
     * @psalm-readonly
     *
     * @var string|null
     */
    public $lastName;

    /**
     * Optional. Additional data about the contact in the form of a vCard, 0-2048 bytes.
     *
     * @psalm-readonly
     *
     * @var string|null
     */
    public $vcard;

    /**
     * Optional. Inline keyboard attached to the message.
     *
     * @psalm-readonly
     *
     * @var InlineKeyboardMarkup|null
     */
    public $replyMarkup;

    /**
     * Optional. Content of the message to be sent instead of the contact.
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
