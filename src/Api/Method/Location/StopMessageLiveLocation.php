<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Method\Location;

use function ServiceBus\TelegramBot\Serializer\jsonEncode;
use ServiceBus\TelegramBot\Api\Method\BotCommand;
use ServiceBus\TelegramBot\Api\Type\Chat\ChatId;
use ServiceBus\TelegramBot\Api\Type\Keyboard\InlineKeyboardMarkup;
use ServiceBus\TelegramBot\Api\Type\Message\InlineMessageId;
use ServiceBus\TelegramBot\Api\Type\Message\Message;
use ServiceBus\TelegramBot\Api\Type\Message\MessageId;

/**
 * Stop updating a live location message before live_period expires.
 *
 * @see https://core.telegram.org/bots/api#stopmessagelivelocation
 */
final class StopMessageLiveLocation implements BotCommand
{
    /**
     * Required if inline_message_id is not specified. Unique identifier for the target chat or username of the target
     * channel (in the format @channelusername).
     *
     * @var ChatId|null
     */
    private $chatId;

    /**
     * Required if inline_message_id is not specified. Identifier of the message to edit.
     *
     * @var MessageId|null
     */
    private $messageId;

    /**
     * Required if chat_id and message_id are not specified. Identifier of the inline message.
     *
     * @var InlineMessageId|null
     */
    private $inlineMessageId;

    /**
     * A JSON-serialized object for a new inline keyboard.
     *
     * @var InlineKeyboardMarkup|null
     */
    private $replyMarkup;

    /**
     * @param ChatId|null          $chatId
     * @param MessageId|null       $messageId
     * @param InlineMessageId|null $inlineMessageId
     *
     * @return self
     */
    public static function create(
        ?ChatId $chatId = null,
        ?MessageId $messageId = null,
        ?InlineMessageId $inlineMessageId = null
    ): self {
        $self = new self();

        $self->chatId          = $chatId;
        $self->messageId       = $messageId;
        $self->inlineMessageId = $inlineMessageId;

        return $self;
    }

    /**
     * @param InlineKeyboardMarkup $replyMarkup
     *
     * @return $this
     */
    public function setupReplayMarkup(InlineKeyboardMarkup $replyMarkup): self
    {
        $this->replyMarkup = $replyMarkup;

        return $this;
    }

    /**
     * @return $this
     */
    public function removeReplayMarkup(): self
    {
        $this->replyMarkup = null;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function methodName(): string
    {
        return 'stopMessageLiveLocation';
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
            'chat_id'           => null !== $this->chatId ? $this->chatId->toString() : null,
            'message_id'        => null !== $this->messageId ? $this->messageId->toString() : null,
            'inline_message_id' => null !== $this->inlineMessageId ? $this->inlineMessageId->toString() : null,
            'reply_markup'      => null !== $this->replyMarkup ? jsonEncode($this->replyMarkup) : null,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function typeClass(): string
    {
        return Message::class;
    }

    private function __construct()
    {
    }
}
