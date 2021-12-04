<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types=0);

namespace ServiceBus\TelegramBot\Api\Method\Location;

use ServiceBus\TelegramBot\Api\Method\SendEntity;
use ServiceBus\TelegramBot\Api\Type\Chat\ChatId;
use ServiceBus\TelegramBot\Api\Type\Location\Location;

/**
 * Send point on the map.
 *
 * @see https://core.telegram.org/bots/api#sendlocation
 */
final class SendLocation extends SendEntity
{
    /**
     * Location.
     *
     * @var Location
     */
    private $coordinates;

    /**
     * Period in seconds for which the location will be updated (see Live Locations, should be between 60 and 86400.
     *
     * @see https://telegram.org/blog/live-locations
     *
     * @var int|null
     */
    private $livePeriod;

    public static function create(ChatId $chatId, Location $coordinates, ?int $livePeriod = null): self
    {
        $self = new self($chatId);

        $self->coordinates = $coordinates;
        $self->livePeriod  = $livePeriod;

        return $self;
    }

    public function methodName(): string
    {
        return 'sendLocation';
    }

    public function requestData(): array
    {
        return \array_filter([
            'chat_id'              => $this->chatId(),
            'latitude'             => $this->coordinates->latitude,
            'longitude'            => $this->coordinates->longitude,
            'live_period'          => $this->livePeriod,
            'disable_notification' => $this->notificationStatus(),
            'reply_to_message_id'  => $this->replyToMessage(),
            'reply_markup'         => $this->replyMarkup(),
        ]);
    }
}
