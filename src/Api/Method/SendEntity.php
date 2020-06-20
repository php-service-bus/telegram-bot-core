<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Method;

use function ServiceBus\Common\jsonEncode;
use ServiceBus\TelegramBot\Api\Type\Chat\ChatId;
use ServiceBus\TelegramBot\Api\Type\Message\Message;
use ServiceBus\TelegramBot\Api\Type\Message\MessageId;
use ServiceBus\TelegramBot\Api\Type\ReplayMarkup;
use ServiceBus\TelegramBot\Interaction\TelegramMethod;

/**
 *
 */
abstract class SendEntity implements TelegramMethod
{
    /**
     * Unique identifier for the target chat or username of the target channel (in the format channelusername).
     *
     * @var ChatId
     */
    private $chatId;

    /**
     * Sends the message silently. Users will receive a notification with no sound.
     *
     * @var bool
     */
    private $disableNotification = false;

    /**
     * If the message is a reply, ID of the original message.
     *
     * @var MessageId|null
     */
    private $replyToMessageId;

    /**
     * Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard,
     * instructions to remove reply keyboard or to force a reply from the user.
     *
     * @var ReplayMarkup|null
     */
    private $replyMarkup;

    /**
     * @param ChatId $chatId
     */
    final protected function __construct(ChatId $chatId)
    {
        $this->chatId = $chatId;
    }

    /**
     * @return $this
     */
    final public function disableNotification(): self
    {
        $this->disableNotification = true;

        return $this;
    }

    /**
     * @return $this
     */
    final public function enableNotification(): self
    {
        $this->disableNotification = false;

        return $this;
    }

    /**
     * @param ReplayMarkup $replyMarkup
     *
     * @return $this
     */
    final public function setupReplayMarkup(ReplayMarkup $replyMarkup): self
    {
        $this->replyMarkup = $replyMarkup;

        return $this;
    }

    /**
     * @return $this
     */
    final public function removeReplayMarkup(): self
    {
        $this->replyMarkup = null;

        return $this;
    }

    /**
     * @param MessageId $messageId
     *
     * @return $this
     */
    final public function replyTo(MessageId $messageId): self
    {
        $this->replyToMessageId = $messageId;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    final public function httpRequestMethod(): string
    {
        return 'POST';
    }

    /**
     * {@inheritdoc}
     */
    final public function typeClass(): string
    {
        return Message::class;
    }

    /**
     * @return string
     */
    final protected function chatId(): string
    {
        return $this->chatId->toString();
    }

    /**
     * @return bool
     */
    final protected function notificationStatus(): bool
    {
        return $this->disableNotification;
    }

    /**
     * @return string|null
     */
    final protected function replyToMessage(): ?string
    {
        return null !== $this->replyToMessageId ? $this->replyToMessageId->toString() : null;
    }

    /**
     * @return string|null
     */
    final protected function replyMarkup(): ?string
    {
        return null !== $this->replyMarkup ? jsonEncode(\get_object_vars($this->replyMarkup)) : null;
    }
}
