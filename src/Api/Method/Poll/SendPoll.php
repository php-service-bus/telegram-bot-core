<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Method\Poll;

use function ServiceBus\Common\jsonEncode;
use ServiceBus\TelegramBot\Api\Method\SendEntity;
use ServiceBus\TelegramBot\Api\Type\Chat\ChatId;

/**
 * Send a native poll.
 *
 * @see https://core.telegram.org/bots/api#sendpoll
 */
final class SendPoll extends SendEntity
{
    /**
     * Poll question, 1-255 characters.
     *
     * @var string
     */
    private $question;

    /**
     * List of answer options, 2-10 strings 1-100 characters each.
     *
     * @var string[]
     */
    private $options;

    /**
     * @param string[]  $options
     */
    public static function create(ChatId $chatId, string $question, array $options): self
    {
        $self = new self($chatId);

        $self->question = $question;
        $self->options  = $options;

        return $self;
    }

    public function addOption(string $option): self
    {
        $this->options[] = $option;

        return $this;
    }

    public function methodName(): string
    {
        return 'sendPoll';
    }

    public function requestData(): array
    {
        return \array_filter([
            'chat_id'              => $this->chatId(),
            'question'             => $this->question,
            'options'              => jsonEncode($this->options),
            'disable_notification' => $this->notificationStatus(),
            'reply_to_message_id'  => $this->replyToMessage(),
            'reply_markup'         => $this->replyMarkup(),
        ]);
    }
}
