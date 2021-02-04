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

use ServiceBus\TelegramBot\Api\Type\InputMessageContent\InputTextMessageContent;
use ServiceBus\TelegramBot\Api\Type\Keyboard\InlineKeyboardMarkup;

/**
 * Represents a link to an article or web page.
 *
 * @see https://core.telegram.org/bots/api#inlinequeryresultarticle
 *
 * @psalm-immutable
 */
final class InlineQueryResultArticle implements InlineQueryResult
{
    /**
     * Type of the result, must be article.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $type = 'article';

    /**
     * Unique identifier for this result, 1-64 Bytes.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $id;

    /**
     * Title of the result.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $title;

    /**
     * Content of the message to be sent.
     *
     * @psalm-readonly
     *
     * @var InputTextMessageContent
     */
    public $inputMessageContent;

    /**
     * Optional. Inline keyboard attached to the message.
     *
     * @psalm-readonly
     *
     * @see https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating
     *
     * @var InlineKeyboardMarkup|null
     */
    public $replyMarkup;

    /**
     * Optional. URL of the result.
     *
     * @psalm-readonly
     *
     * @var string|null
     */
    public $url;

    /**
     * Optional. Pass True, if you don't want the URL to be shown in the message.
     *
     * @psalm-readonly
     *
     * @var bool
     */
    public $hideUrl = false;

    /**
     * Optional. Short description of the result.
     *
     * @psalm-readonly
     *
     * @var string|null
     */
    public $description;

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
