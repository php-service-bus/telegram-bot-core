<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Type\Chat;

use ServiceBus\TelegramBot\Api\Type\Common\UnixTime;
use ServiceBus\TelegramBot\Api\Type\User\User;

/**
 * Contains information about one member of a chat.
 *
 * @see https://core.telegram.org/bots/api#chatmember
 *
 * @property-read User             $user
 * @property-read ChatMemberStatus $status
 * @property-read UnixTime|null    $untilDate
 * @property-read bool             $canBeEdited
 * @property-read bool             $canChangeInfo
 * @property-read bool             $canPostMessages
 * @property-read bool             $canEditMessages
 * @property-read bool             $canDeleteMessages
 * @property-read bool             $canInviteUsers
 * @property-read bool             $canRestrictMembers
 * @property-read bool             $canPinMessages
 * @property-read bool             $canPromoteMembers
 * @property-read bool             $isMember
 * @property-read bool             $canSendMessages
 * @property-read bool             $canSendMediaMessages
 * @property-read bool             $canSendOtherMessages
 * @property-read bool             $canAddWebPagePreviews
 */
final class ChatMember
{
    /**
     * Information about the user.
     *
     * @var User
     */
    public $user;

    /**
     * The member's status in the chat.
     *
     * @var ChatMemberStatus
     */
    public $status;

    /**
     * Optional. Restricted and kicked only. Date when restrictions will be lifted for this user, unix time.
     *
     * @var UnixTime|null
     */
    public $untilDate;

    /**
     * Optional. Administrators only. True, if the bot is allowed to edit administrator privileges of that user.
     *
     * @var bool
     */
    public $canBeEdited = false;

    /**
     * Optional. Administrators only. True, if the administrator can change the chat title, photo and other settings.
     *
     * @var bool
     */
    public $canChangeInfo = false;

    /**
     * Optional. Administrators only. True, if the administrator can post in the channel, channels only.
     *
     * @var bool
     */
    public $canPostMessages = false;

    /**
     * Optional. Administrators only. True, if the administrator can edit messages of other users and can pin messages,
     * channels only.
     *
     * @var bool
     */
    public $canEditMessages = false;

    /**
     * Optional. Administrators only. True, if the administrator can delete messages of other users.
     *
     * @var bool
     */
    public $canDeleteMessages = false;

    /**
     * Optional. Administrators only. True, if the administrator can invite new users to the chat.
     *
     * @var bool
     */
    public $canInviteUsers = false;

    /**
     * Optional. Administrators only. True, if the administrator can restrict, ban or unban chat members.
     *
     * @var bool
     */
    public $canRestrictMembers = false;

    /**
     * Optional. Administrators only. True, if the administrator can pin messages, groups and supergroups only.
     *
     * @var bool
     */
    public $canPinMessages = false;

    /**
     * Optional. Administrators only. True, if the administrator can add new administrators with a subset of his own
     * privileges or demote administrators that he has promoted, directly or indirectly (promoted by administrators
     * that were appointed by the user).
     *
     * @var bool
     */
    public $canPromoteMembers = false;

    /**
     * Optional. Restricted only. True, if the user is a member of the chat at the moment of the request.
     *
     * @var bool
     */
    public $isMember = false;

    /**
     * Optional. Restricted only. True, if the user can send text messages, contacts, locations and venues.
     *
     * @var bool
     */
    public $canSendMessages = false;

    /**
     * Optional. Restricted only. True, if the user can send audios, documents, photos, videos, video notes and voice
     * notes, implies can_send_messages.
     *
     * @var bool
     */
    public $canSendMediaMessages = false;

    /**
     * Optional. Restricted only. True, if the user can send animations, games, stickers and use inline bots, implies
     * can_send_media_messages.
     *
     * @var bool
     */
    public $canSendOtherMessages = false;

    /**
     * Optional. Restricted only. True, if user may add web page previews to his messages, implies
     * can_send_media_messages.
     *
     * @var bool
     */
    public $canAddWebPagePreviews = false;
}
