<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Method\InlineQuery;

use function ServiceBus\TelegramBot\Serializer\jsonEncode;
use ServiceBus\TelegramBot\Api\Method\BotCommand;
use ServiceBus\TelegramBot\Api\Type\InlineQueryResult\InlineQueryResult;
use ServiceBus\TelegramBot\Api\Type\SimpleSuccessResponse;

/**
 * Send answers to an inline query. No more than 50 results per query are allowed.
 *
 * @see https://core.telegram.org/bots/api#answerinlinequery
 */
final class AnswerInlineQuery implements BotCommand
{
    /**
     * Unique identifier for the answered query.
     *
     * @var string
     */
    private $inlineQueryId;

    /**
     * A JSON-serialized array of results for the inline query.
     *
     * @var InlineQueryResult[]
     */
    private $results;

    /**
     * The maximum amount of time in seconds that the result of the inline query may be cached on the server. Defaults
     * to 300.
     *
     * @var int
     */
    private $cacheTime = 300;

    /**
     * Pass True, if results may be cached on the server side only for the user that sent the query. By default,
     * results may be returned to any user who sends the same query.
     *
     * @var bool
     */
    private $isPersonal = false;

    /**
     * Pass the offset that a client should send in the next query with the same text to receive more results. Pass an
     * empty string if there are no more results or if you don‘t support pagination. Offset length can’t exceed 64
     * bytes.
     *
     * @var string|null
     */
    private $nextOffset;

    /**
     * If passed, clients will display a button with specified text that switches the user to a private chat with the
     * bot and sends the bot a start message with the parameter switch_pm_parameter.
     *
     * @var string|null
     */
    private $switchPmText;

    /**
     * Deep-linking parameter for the /start message sent to the bot when user presses the switch button. 1-64
     * characters, only A-Z, a-z, 0-9, _ and - are allowed.
     *
     * Example: An inline bot that sends YouTube videos can ask the user to connect the bot to their YouTube account to
     * adapt search results accordingly. To do this, it displays a ‘Connect your YouTube account’ button above the
     * results, or even before showing any. The user presses the button, switches to a private chat with the bot and,
     * in doing so, passes a start parameter that instructs the bot to return an oauth link. Once done, the bot can
     * offer a switch_inline button so that the user can easily return to the chat where they wanted to use the bot's
     * inline capabilities.
     *
     * @var string|null
     */
    private $switchPmParameter;

    /**
     * @param string              $inlineQueryId
     * @param InlineQueryResult[] $results
     * @param string|null         $switchPmText
     * @param string|null         $switchPmParameter
     *
     * @return self
     */
    public static function create(
        string $inlineQueryId,
        array $results,
        ?string $switchPmText = null,
        ?string $switchPmParameter = null
    ): self {
        $self = new self();

        $self->inlineQueryId     = $inlineQueryId;
        $self->results           = $results;
        $self->switchPmText      = $switchPmText;
        $self->switchPmParameter = $switchPmParameter;

        return $self;
    }

    /**
     * @return $this
     */
    public function makePersonal(): self
    {
        $this->isPersonal = true;

        return $this;
    }

    /**
     * @param int $ttl
     *
     * @return $this
     */
    public function changeCacheTtl(int $ttl): self
    {
        $this->cacheTime = $ttl;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function methodName(): string
    {
        return 'answerInlineQuery';
    }

    /**
     * {@inheritdoc}
     */
    public function httpRequestMethod(): string
    {
        return 'POST';
    }

    /**
     * {@inheritdoc}
     */
    public function requestData(): array
    {
        return \array_filter([
            'inline_query_id'     => $this->inlineQueryId,
            'results'             => jsonEncode($this->results),
            'cache_time'          => $this->cacheTime,
            'is_personal'         => $this->isPersonal,
            'next_offset'         => $this->nextOffset,
            'switch_pm_text'      => $this->switchPmText,
            'switch_pm_parameter' => $this->switchPmParameter,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function typeClass(): string
    {
        return SimpleSuccessResponse::class;
    }

    private function __construct()
    {
    }
}
