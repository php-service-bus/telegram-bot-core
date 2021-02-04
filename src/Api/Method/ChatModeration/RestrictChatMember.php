<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
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
 * Restrict a user in a supergroup. The bot must be an administrator in the supergroup for this to work and must have
 * the appropriate admin rights. Pass True for all boolean parameters to lift restrictions from a user.
 *
 * @see https://core.telegram.org/bots/api#restrictchatmember
 */
final class RestrictChatMember implements TelegramMethod
{
    /**
     * Unique identifier for the target chat or username of the target supergroup (in the format supergroupusername).
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
     * Date when restrictions will be lifted for the user, unix time. If user is restricted for more than 366 days or
     * less than 30 seconds from the current time, they are considered to be restricted forever.
     *
     * @var \DateTimeImmutable|null
     */
    private $untilDate;

    /**
     * Pass True, if the user can send text messages, contacts, locations and venues.
     *
     * @var bool
     */
    private $canSendMessages = false;

    /**
     * Pass True, if the user can send audios, documents, photos, videos, video notes and voice notes, implies
     * can_send_messages.
     *
     * @var bool
     */
    private $canSendMediaMessages = false;

    /**
     * Pass True, if the user can send animations, games, stickers and use inline bots, implies can_send_media_messages.
     *
     * @var bool
     */
    private $canSendOtherMessages = false;

    /**
     * Pass True, if the user may add web page previews to their messages, implies can_send_media_messages.
     *
     * @var bool
     */
    private $canAddWebPagePreviews = false;

    public static function create(ChatId $chatId, UserId $userId, ?\DateTimeImmutable $untilDate): self
    {
        $self = new self();

        $self->chatId    = $chatId;
        $self->userId    = $userId;
        $self->untilDate = $untilDate;

        return $self;
    }

    public static function restrictAll(ChatId $chatId, UserId $userId, ?\DateTimeImmutable $untilDate): self
    {
        $self = new self();

        $self->chatId                = $chatId;
        $self->userId                = $userId;
        $self->untilDate             = $untilDate;
        $self->canSendMessages       = false;
        $self->canSendMediaMessages  = false;
        $self->canSendOtherMessages  = false;
        $self->canAddWebPagePreviews = false;

        return $self;
    }

    public function allowSendMessages(): self
    {
        $this->canSendMessages = true;

        return $this;
    }

    public function allowSendMediaMessages(): self
    {
        $this->canSendMediaMessages = true;

        return $this;
    }

    public function allowSendOtherMessages(): self
    {
        $this->canSendOtherMessages = true;

        return $this;
    }

    public function allowAddWebPagePreviews(): self
    {
        $this->canAddWebPagePreviews = true;

        return $this;
    }

    public function methodName(): string
    {
        return 'restrictChatMember';
    }

    public function httpRequestMethod(): string
    {
        return 'POST';
    }

    public function requestData(): array
    {
        return [
            'chat_id'                   => $this->chatId->toString(),
            'user_id'                   => $this->userId->toString(),
            'until_date'                => $this->untilDate?->getTimestamp(),
            'can_send_messages'         => $this->canSendMessages,
            'can_send_media_messages'   => $this->canSendMediaMessages,
            'can_send_other_messages'   => $this->canSendOtherMessages,
            'can_add_web_page_previews' => $this->canAddWebPagePreviews,
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
