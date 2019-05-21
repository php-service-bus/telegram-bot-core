<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Type\InputMessageContent;

use ServiceBus\TelegramBot\Api\Type\ParseMode;

/**
 * Represents the content of a text message to be sent as the result of an inline query.
 *
 * @see https://core.telegram.org/bots/api#inputtextmessagecontent
 *
 * @property-read string         $messageText
 * @property-read ParseMode|null $parseMode
 * @property-read bool           $disableWebPagePreview
 */
final class InputTextMessageContent implements InputMessageContent
{
    /**
     * Text of the message to be sent, 1-4096 characters.
     *
     * @var string
     */
    public $messageText;

    /**
     * Optional. Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs
     * in your bot's message.
     *
     * @var ParseMode|null
     */
    public $parseMode;

    /**
     * Optional. Disables link previews for links in the sent message.
     *
     * @var bool
     */
    public $disableWebPagePreview = false;
}
