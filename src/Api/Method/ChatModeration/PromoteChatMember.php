<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 0);

namespace ServiceBus\TelegramBot\Api\Method\ChatModeration;

use ServiceBus\TelegramBot\Api\Type\Chat\ChatId;
use ServiceBus\TelegramBot\Api\Type\SimpleSuccessResponse;
use ServiceBus\TelegramBot\Api\Type\User\UserId;
use ServiceBus\TelegramBot\Interaction\TelegramMethod;

/**
 * Promote or demote a user in a supergroup or a channel. The bot must be an administrator in the chat for this to work
 * and must have the appropriate admin rights. Pass False for all boolean parameters to demote a user.
 *
 * @see https://core.telegram.org/bots/api#promotechatmember
 */
final class PromoteChatMember implements TelegramMethod
{
    /**
     * Unique identifier for the target chat or username of the target channel (in the format channelusername).
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
     * Pass True, if the administrator can change chat title, photo and other settings.
     *
     * @var bool
     */
    private $canChangeInfo = false;

    /**
     * Pass True, if the administrator can create channel posts, channels only.
     *
     * @var bool
     */
    private $canPostMessages = false;

    /**
     * Pass True, if the administrator can edit messages of other users and can pin messages, channels only.
     *
     * @var bool
     */
    private $canEditMessages = false;

    /**
     * Pass True, if the administrator can delete messages of other users.
     *
     * @var bool
     */
    private $canDeleteMessages = false;

    /**
     * Pass True, if the administrator can invite new users to the chat.
     *
     * @var bool
     */
    private $canInviteUsers = false;

    /**
     * Pass True, if the administrator can restrict, ban or unban chat members.
     *
     * @var bool
     */
    private $canRestrictMembers = false;

    /**
     * Pass True, if the administrator can pin messages, supergroups only.
     *
     * @var bool
     */
    private $canPinMessages = false;

    /**
     * Pass True, if the administrator can add new administrators with a subset of his own privileges or demote
     * administrators that he has promoted, directly or indirectly (promoted by administrators that were appointed by
     * him).
     *
     * @var bool
     */
    private $canPromoteMembers = false;

    public static function create(ChatId $chatId, UserId $userId): self
    {
        $self = new self();

        $self->chatId = $chatId;
        $self->userId = $userId;

        return $self;
    }

    public static function grantAll(ChatId $chatId, UserId $userId): self
    {
        $self = new self();

        $self->chatId             = $chatId;
        $self->userId             = $userId;
        $self->canChangeInfo      = true;
        $self->canPostMessages    = true;
        $self->canEditMessages    = true;
        $self->canDeleteMessages  = true;
        $self->canInviteUsers     = true;
        $self->canRestrictMembers = true;
        $self->canPinMessages     = true;
        $self->canPromoteMembers  = true;

        return $self;
    }

    public function allowPromoteMembers(): self
    {
        $this->canPromoteMembers = true;

        return $this;
    }

    public function allowPinMessages(): self
    {
        $this->canPinMessages = true;

        return $this;
    }

    public function allowRestrictMembers(): self
    {
        $this->canRestrictMembers = true;

        return $this;
    }

    public function allowInviteUsers(): self
    {
        $this->canInviteUsers = true;

        return $this;
    }

    public function allowDeleteMessages(): self
    {
        $this->canDeleteMessages = true;

        return $this;
    }

    public function allowEditMessages(): self
    {
        $this->canEditMessages = true;

        return $this;
    }

    public function allowPostMessages(): self
    {
        $this->canPostMessages = true;

        return $this;
    }

    public function allowChangeInfo(): self
    {
        $this->canChangeInfo = true;

        return $this;
    }

    public function methodName(): string
    {
        return 'promoteChatMember';
    }

    public function httpRequestMethod(): string
    {
        return 'POST';
    }

    public function requestData(): array
    {
        return [
            'chat_id'              => $this->chatId->toString(),
            'user_id'              => $this->userId->toString(),
            'can_change_info'      => $this->canChangeInfo,
            'can_post_messages'    => $this->canPostMessages,
            'can_edit_messages'    => $this->canEditMessages,
            'can_delete_messages'  => $this->canDeleteMessages,
            'can_invite_users'     => $this->canInviteUsers,
            'can_restrict_members' => $this->canRestrictMembers,
            'can_pin_messages'     => $this->canPinMessages,
            'can_promote_members'  => $this->canPromoteMembers,
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
