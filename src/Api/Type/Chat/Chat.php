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

use ServiceBus\TelegramBot\Api\Type\Message\Message;

/**
 * Represents a chat.
 *
 * @see https://core.telegram.org/bots/api#chat
 *
 * @psalm-readonly
 */
final class Chat
{
    /**
     * Unique identifier for this chat. This number may be greater than 32 bits and some programming languages may have
     * difficulty/silent defects in interpreting it. But it is smaller than 52 bits, so a signed 64 bit integer or
     * double-precision float type are safe for storing this identifier.
     *
     * @var ChatId
     */
    public $id;

    /**
     * Type of chat.
     *
     * @var ChatType
     */
    public $type;

    /**
     * Optional. Title, for supergroups, channels and group chats.
     *
     * @var string|null
     */
    public $title;

    /**
     * Optional. Username, for private chats, supergroups and channels if available.
     *
     * @var string|null
     */
    public $username;

    /**
     * Optional. First name of the other party in a private chat.
     *
     * @var string|null
     */
    public $firstName;

    /**
     * Optional. Last name of the other party in a private chat.
     *
     * @var string|null
     */
    public $lastName;

    /**
     * Optional. True if a group has ‘All Members Are Admins’ enabled.
     *
     * @var bool
     */
    public $allMembersAreAdministrators = false;

    /**
     * Optional. Chat photo. Returned only in getChat.
     *
     * @see https://core.telegram.org/bots/api#getchat
     *
     * @var ChatPhoto|null
     */
    public $photo;

    /**
     * Optional. Description, for supergroups and channel chats. Returned only in getChat.
     *
     * @see https://core.telegram.org/bots/api#getchat
     *
     * @var string|null
     */
    public $description;

    /**
     * Optional. Chat invite link, for supergroups and channel chats. Each administrator in a chat generates their own
     * invite links, so the bot must first generate the link using exportChatInviteLink. Returned only in getChat.
     *
     * @see https://core.telegram.org/bots/api#getchat
     * @see https://core.telegram.org/bots/api#exportchatinvitelink
     *
     * @var string|null
     */
    public $inviteLink;

    /**
     * Optional. Pinned message, for groups, supergroups and channels. Returned only in getChat.
     *
     * @see https://core.telegram.org/bots/api#getchat
     *
     * @var Message|null
     */
    public $pinnedMessage;

    /**
     * Optional. For supergroups, name of group sticker set. Returned only in getChat.
     *
     * @see https://core.telegram.org/bots/api#getchat
     *
     * @var string|null
     */
    public $stickerSetName;

    /**
     * Optional. True, if the bot can change the group sticker set. Returned only in getChat.
     *
     * @see https://core.telegram.org/bots/api#getchat
     *
     * @var bool
     */
    public $canSetStickerSet = false;
}
