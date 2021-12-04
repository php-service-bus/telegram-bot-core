<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types=0);

namespace ServiceBus\TelegramBot\Api\Method\Message;

use ServiceBus\TelegramBot\Api\Method\SendEntity;
use ServiceBus\TelegramBot\Api\Type\Chat\ChatId;
use ServiceBus\TelegramBot\Api\Type\ParseMode;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Send text messages.
 *
 * @see https://core.telegram.org/bots/api#sendmessage
 */
final class SendMessage extends SendEntity
{
    /**
     * Text of the message to be sent.
     *
     * @Assert\NotBlank()
     *
     * @var string
     */
    private $text;

    /**
     * Send Markdown or HTML, if you want Telegram apps to show bold, italic, fixed-width text or inline URLs in your
     * bot's message.
     *
     * @var ParseMode|null
     */
    private $parseMode;

    /**
     * Disables link previews for links in this message.
     *
     * @var bool
     */
    private $disableWebPagePreview = false;

    public static function create(ChatId $chatId, string $text): self
    {
        $self = new self($chatId);

        $self->text = $text;

        return $self;
    }

    public function disableWebPagePreview(): self
    {
        $this->disableWebPagePreview = true;

        return $this;
    }

    public function enableWebPagePreview(): self
    {
        $this->disableWebPagePreview = true;

        return $this;
    }

    public function useMarkdown(): self
    {
        $this->parseMode = ParseMode::markdown();

        return $this;
    }

    public function useHtml(): self
    {
        $this->parseMode = ParseMode::html();

        return $this;
    }

    public function methodName(): string
    {
        return 'sendMessage';
    }

    public function requestData(): array
    {
        return \array_filter(
            [
                'chat_id'                  => $this->chatId(),
                'text'                     => $this->text,
                'disable_web_page_preview' => $this->disableWebPagePreview,
                'disable_notification'     => $this->notificationStatus(),
                'reply_to_message_id'      => $this->replyToMessage(),
                'parse_mode'               => $this->parseMode?->toString(),
                'reply_markup'             => $this->replyMarkup(),
            ]
        );
    }
}
