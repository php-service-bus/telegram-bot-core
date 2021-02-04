<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Method\CallbackQuery;

use ServiceBus\TelegramBot\Api\Type\SimpleSuccessResponse;
use ServiceBus\TelegramBot\Interaction\TelegramMethod;

/**
 * Send answers to callback queries sent from inline keyboards. The answer will be displayed to the user as a
 * notification at the top of the chat screen or as an alert.
 *
 * @see https://core.telegram.org/bots/api#answercallbackquery
 */
final class AnswerCallbackQuery implements TelegramMethod
{
    /**
     * Unique identifier for the query to be answered.
     *
     * @var string
     */
    private $callbackQueryId;

    /**
     * Text of the notification. If not specified, nothing will be shown to the user, 0-200 characters.
     *
     * @var string|null
     */
    private $text;

    /**
     * If true, an alert will be shown by the client instead of a notification at the top of the chat screen. Defaults
     * to false.
     *
     * @var bool
     */
    private $showAlert = false;

    /**
     * URL that will be opened by the user's client. If you have created a Game and accepted the conditions via
     * Botfather, specify the URL that opens your game – note that this will only work if the query comes from a
     * callback_game button.
     *
     * Otherwise, you may use links like t.me/your_bot?start=XXXX that open your bot with a parameter.
     *
     * @var string|null
     */
    private $url;

    /**
     * The maximum amount of time in seconds that the result of the callback query may be cached client-side. Telegram
     * apps will support caching starting in version 3.14. Defaults to 0.
     *
     * @var int
     */
    private $cacheTime = 0;

    public static function create(string $callbackQueryId, ?string $text): self
    {
        $self = new self();

        $self->callbackQueryId = $callbackQueryId;
        $self->text            = $text;

        return $self;
    }

    public function showAlert(): self
    {
        $this->showAlert = true;

        return $this;
    }

    public function appendUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function changeCacheTtl(int $ttl): self
    {
        $this->cacheTime = $ttl;

        return $this;
    }

    public function methodName(): string
    {
        return 'answerCallbackQuery';
    }

    public function httpRequestMethod(): string
    {
        return 'POST';
    }

    public function requestData(): array
    {
        return \array_filter([
            'callback_query_id' => $this->callbackQueryId,
            'text'              => $this->text,
            'show_alert'        => $this->showAlert,
            'url'               => $this->url,
            'cache_time'        => $this->cacheTime,
        ]);
    }

    public function typeClass(): string
    {
        return SimpleSuccessResponse::class;
    }

    private function __construct()
    {
    }
}
