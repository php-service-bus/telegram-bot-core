<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types=0);

namespace ServiceBus\TelegramBot\Api\Method\ChatModeration;

use ServiceBus\TelegramBot\Api\Type\Chat\ChatId;
use ServiceBus\TelegramBot\Api\Type\SimpleSuccessResponse;
use ServiceBus\TelegramBot\Api\Type\User\UserId;
use ServiceBus\TelegramBot\Interaction\TelegramMethod;

/**
 * Unban a previously kicked user in a supergroup or channel. The user will not return to the group or channel
 * automatically, but will be able to join via link, etc. The bot must be an administrator for this to work.
 *
 * @see https://core.telegram.org/bots/api#unbanchatmember
 */
final class UnbanChatMember implements TelegramMethod
{
    /**
     * Unique identifier for the target group or username of the target supergroup or channel (in the format username).
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

    public static function create(ChatId $chatId, UserId $userId): self
    {
        $self = new self();

        $self->chatId = $chatId;
        $self->userId = $userId;

        return $self;
    }

    public function methodName(): string
    {
        return 'unbanChatMember';
    }

    public function httpRequestMethod(): string
    {
        return 'POST';
    }

    public function requestData(): array
    {
        return [
            'chat_id' => $this->chatId->toString(),
            'user_id' => $this->userId->toString(),
        ];
    }

    public function typeClass(): string
    {
        return SimpleSuccessResponse::class;
    }

    private function __construct()
    {
    }
}
