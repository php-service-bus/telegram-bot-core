<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 0);

namespace ServiceBus\TelegramBot\Api\Method\Location;

use ServiceBus\TelegramBot\Api\Method\SendEntity;
use ServiceBus\TelegramBot\Api\Type\Chat\ChatId;
use ServiceBus\TelegramBot\Api\Type\Location\Location;

/**
 * Send information about a venue.
 *
 * @see https://core.telegram.org/bots/api#sendvenue
 */
final class SendVenue extends SendEntity
{
    /**
     * Location.
     *
     * @var Location
     */
    private $coordinates;

    /**
     * Name of the venue.
     *
     * @var string
     */
    private $title;

    /**
     * Address of the venue.
     *
     * @var string
     */
    private $address;

    /**
     * Foursquare identifier of the venue.
     *
     * @var string|null
     */
    private $foursquareId;

    /**
     * Foursquare type of the venue, if known. (For example, “arts_entertainment/default”,
     * “arts_entertainment/aquarium” or “food/icecream”.).
     *
     * @var string|null
     */
    private $foursquareType;

    public static function create(ChatId $chatId, Location $coordinates, string $title, string $address): self
    {
        $self = new self($chatId);

        $self->coordinates = $coordinates;
        $self->title       = $title;
        $self->address     = $address;

        return $self;
    }

    public function setupFoursquareType(string $foursquareType): self
    {
        $this->foursquareType = $foursquareType;

        return $this;
    }

    public function unsetFoursquareType(): self
    {
        $this->foursquareType = null;

        return $this;
    }

    public function setupFoursquareId(string $foursquareId): self
    {
        $this->foursquareId = $foursquareId;

        return $this;
    }

    public function unsetFoursquareId(): self
    {
        $this->foursquareId = null;

        return $this;
    }

    public function methodName(): string
    {
        return 'sendVenue';
    }

    public function requestData(): array
    {
        return \array_filter([
            'chat_id'              => $this->chatId(),
            'latitude'             => $this->coordinates->latitude,
            'longitude'            => $this->coordinates->longitude,
            'title'                => $this->title,
            'address'              => $this->address,
            'foursquare_id'        => $this->foursquareId,
            'foursquare_type'      => $this->foursquareType,
            'disable_notification' => $this->notificationStatus(),
            'reply_to_message_id'  => $this->replyToMessage(),
            'reply_markup'         => $this->replyMarkup(),
        ]);
    }
}
