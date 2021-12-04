<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types=0);

namespace ServiceBus\TelegramBot\Api\Method\Contact;

use ServiceBus\TelegramBot\Api\Method\SendEntity;
use ServiceBus\TelegramBot\Api\Type\Chat\ChatId;

/**
 * Send phone contacts.
 *
 * @see https://core.telegram.org/bots/api#sendcontact
 */
final class SendContact extends SendEntity
{
    /**
     * Contact's phone number.
     *
     * @var string
     */
    private $phoneNumber;

    /**
     * Contact's first name.
     *
     * @var string
     */
    private $firstName;

    /**
     * Contact's last name.
     *
     * @var string|null
     */
    private $lastName;

    /**
     * Additional data about the contact in the form of a vCard, 0-2048 bytes.
     *
     * @var string|null
     */
    private $vcard;

    public static function create(ChatId $chatId, string $phoneNumber, string $firstName): self
    {
        $self = new self($chatId);

        $self->phoneNumber = $phoneNumber;
        $self->firstName   = $firstName;

        return $self;
    }

    public function methodName(): string
    {
        return 'sendContact';
    }

    public function requestData(): array
    {
        return \array_filter([
            'chat_id'              => $this->chatId(),
            'disable_notification' => $this->notificationStatus(),
            'reply_to_message_id'  => $this->replyToMessage(),
            'reply_markup'         => $this->replyMarkup(),
            'last_name'            => $this->lastName,
            'vcard'                => $this->vcard,
            'phone_number'         => $this->phoneNumber,
            'first_name'           => $this->firstName,
        ]);
    }
}
