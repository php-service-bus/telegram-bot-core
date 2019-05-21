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

use ServiceBus\TelegramBot\Api\Type\InputMessageContent\InputTextMessageContent;
use ServiceBus\TelegramBot\Api\Type\Keyboard\InlineKeyboardMarkup;

/**
 * Represents a link to an article or web page.
 *
 * @see https://core.telegram.org/bots/api#inlinequeryresultarticle
 *
 * @property-read string                    $type
 * @property-read string                    $id
 * @property-read string                    $title
 * @property-read InputTextMessageContent   $inputMessageContent
 * @property-read InlineKeyboardMarkup|null $replyMarkup
 * @property-read string|null               $url
 * @property-read bool                      $hideUrl
 * @property-read string|null               $description
 * @property-read string|null               $thumbUrl
 * @property-read int|null                  $thumbWidth
 * @property-read int|null                  $thumbHeight
 */
final class InlineQueryResultArticle implements InlineQueryResult
{
    /**
     * Type of the result, must be article.
     *
     * @var string
     */
    public $type = 'article';

    /**
     * Unique identifier for this result, 1-64 Bytes.
     *
     * @var string
     */
    public $id;

    /**
     * Title of the result.
     *
     * @var string
     */
    public $title;

    /**
     * Content of the message to be sent.
     *
     * @var InputTextMessageContent
     */
    public $inputMessageContent;

    /**
     * Optional. Inline keyboard attached to the message.
     *
     * @see https://core.telegram.org/bots#inline-keyboards-and-on-the-fly-updating
     *
     * @var InlineKeyboardMarkup|null
     */
    public $replyMarkup;

    /**
     * Optional. URL of the result.
     *
     * @var string|null
     */
    public $url;

    /**
     * Optional. Pass True, if you don't want the URL to be shown in the message.
     *
     * @var bool
     */
    public $hideUrl = false;

    /**
     * Optional. Short description of the result.
     *
     * @var string|null
     */
    public $description;

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
