<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types=0);

namespace ServiceBus\TelegramBot\Api\Type\Chat;

use ServiceBus\TelegramBot\Api\Type\Common\UnixTime;
use ServiceBus\TelegramBot\Api\Type\User\User;

/**
 * Contains information about one member of a chat.
 *
 * @see https://core.telegram.org/bots/api#chatmember
 *
 * @psalm-immutable
 */
final class ChatMember
{
    /**
     * Information about the user.
     *
     * @psalm-readonly
     *
     * @var User
     */
    public $user;

    /**
     * The member's status in the chat.
     *
     * @psalm-readonly
     *
     * @var ChatMemberStatus
     */
    public $status;

    /**
     * Optional. Restricted and kicked only. Date when restrictions will be lifted for this user, unix time.
     *
     * @psalm-readonly
     *
     * @var UnixTime|null
     */
    public $untilDate;

    /**
     * Optional. Administrators only. True, if the bot is allowed to edit administrator privileges of that user.
     *
     * @psalm-readonly
     *
     * @var bool
     */
    public $canBeEdited = false;

    /**
     * Optional. Administrators only. True, if the administrator can change the chat title, photo and other settings.
     *
     * @psalm-readonly
     *
     * @var bool
     */
    public $canChangeInfo = false;

    /**
     * Optional. Administrators only. True, if the administrator can post in the channel, channels only.
     *
     * @psalm-readonly
     *
     * @var bool
     */
    public $canPostMessages = false;

    /**
     * Optional. Administrators only. True, if the administrator can edit messages of other users and can pin messages,
     * channels only.
     *
     * @psalm-readonly
     *
     * @var bool
     */
    public $canEditMessages = false;

    /**
     * Optional. Administrators only. True, if the administrator can delete messages of other users.
     *
     * @psalm-readonly
     *
     * @var bool
     */
    public $canDeleteMessages = false;

    /**
     * Optional. Administrators only. True, if the administrator can invite new users to the chat.
     *
     * @psalm-readonly
     *
     * @var bool
     */
    public $canInviteUsers = false;

    /**
     * Optional. Administrators only. True, if the administrator can restrict, ban or unban chat members.
     *
     * @psalm-readonly
     *
     * @var bool
     */
    public $canRestrictMembers = false;

    /**
     * Optional. Administrators only. True, if the administrator can pin messages, groups and supergroups only.
     *
     * @psalm-readonly
     *
     * @var bool
     */
    public $canPinMessages = false;

    /**
     * Optional. Administrators only. True, if the administrator can add new administrators with a subset of his own
     * privileges or demote administrators that he has promoted, directly or indirectly (promoted by administrators
     * that were appointed by the user).
     *
     * @psalm-readonly
     *
     * @var bool
     */
    public $canPromoteMembers = false;

    /**
     * Optional. Restricted only. True, if the user is a member of the chat at the moment of the request.
     *
     * @psalm-readonly
     *
     * @var bool
     */
    public $isMember = false;

    /**
     * Optional. Restricted only. True, if the user can send text messages, contacts, locations and venues.
     *
     * @psalm-readonly
     *
     * @var bool
     */
    public $canSendMessages = false;

    /**
     * Optional. Restricted only. True, if the user can send audios, documents, photos, videos, video notes and voice
     * notes, implies can_send_messages.
     *
     * @psalm-readonly
     *
     * @var bool
     */
    public $canSendMediaMessages = false;

    /**
     * Optional. Restricted only. True, if the user can send animations, games, stickers and use inline bots, implies
     * can_send_media_messages.
     *
     * @psalm-readonly
     *
     * @var bool
     */
    public $canSendOtherMessages = false;

    /**
     * Optional. Restricted only. True, if user may add web page previews to his messages, implies
     * can_send_media_messages.
     *
     * @psalm-readonly
     *
     * @var bool
     */
    public $canAddWebPagePreviews = false;
}
