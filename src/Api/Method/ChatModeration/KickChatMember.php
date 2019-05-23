<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Method\ChatModeration;

use ServiceBus\TelegramBot\Api\Type\Chat\ChatId;
use ServiceBus\TelegramBot\Api\Type\SimpleSuccessResponse;
use ServiceBus\TelegramBot\Api\Type\User\UserId;
use ServiceBus\TelegramBot\Interaction\TelegramMethod;

/**
 * Kick a user from a group, a supergroup or a channel. In the case of supergroups and channels, the user will not be
 * able to return to the group on their own using invite links, etc., unless unbanned first. The bot must be an
 * administrator in the chat for this to work and must have the appropriate admin rights.
 *
 * @see https://core.telegram.org/bots/api#kickchatmember
 */
final class KickChatMember implements TelegramMethod
{
    /**
     * Unique identifier for the target group or username of the target supergroup or channel (in the format
     * channelusername).
     *
     * @var ChatId
     */
    private $chatId;

    /**
     * Unique identifier of the target user.
     *
     * @var UserId
     */
    private $userId;

    /**
     * Date when the user will be unbanned, unix time. If user is banned for more than 366 days or less than 30 seconds
     * from the current time they are considered to be banned forever.
     *
     * @var \DateTimeImmutable|null
     */
    private $untilDate;

    /**
     * @param ChatId                  $chatId
     * @param UserId                  $userId
     * @param \DateTimeImmutable|null $untilDate
     *
     * @return self
     */
    public static function create(ChatId $chatId, UserId $userId, ?\DateTimeImmutable $untilDate): self
    {
        $self = new self();

        $self->chatId    = $chatId;
        $self->userId    = $userId;
        $self->untilDate = $untilDate;

        return $self;
    }

    /**
     * {@inheritdoc}
     */
    public function methodName(): string
    {
        return 'kickChatMember';
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
            'chat_id'    => $this->chatId->toString(),
            'user_id'    => $this->userId->toString(),
            'until_date' => null !== $this->untilDate ? $this->untilDate->getTimestamp() : null,
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
