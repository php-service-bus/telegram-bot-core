<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 0);

namespace ServiceBus\TelegramBot\Api\Method\ChatManage;

use ServiceBus\TelegramBot\Api\Method\Chat\ChatInviteLink;
use ServiceBus\TelegramBot\Api\Type\Chat\ChatId;
use ServiceBus\TelegramBot\Interaction\TelegramMethod;

/**
 * Generate a new invite link for a chat; any previously generated link is revoked. The bot must be an administrator in
 * the chat for this to work and must have the appropriate admin rights. Returns the new invite link.
 */
final class ExportChatInviteLink implements TelegramMethod
{
    /**
     * Unique identifier for the target chat or username of the target channel (in the format channelusername).
     *
     * @var ChatId
     */
    private $chatId;

    public static function create(ChatId $chatId): self
    {
        $self = new self();

        $self->chatId = $chatId;

        return $self;
    }

    public function methodName(): string
    {
        return 'exportChatInviteLink';
    }

    public function httpRequestMethod(): string
    {
        return 'POST';
    }

    public function requestData(): array
    {
        return [
            'chat_id' => $this->chatId->toString(),
        ];
    }

    public function typeClass(): string
    {
        return ChatInviteLink::class;
    }

    private function __construct()
    {
    }
}
