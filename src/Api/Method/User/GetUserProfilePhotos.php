<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Method\User;

use ServiceBus\TelegramBot\Api\Type\User\UserId;
use ServiceBus\TelegramBot\Api\Type\User\UserProfilePhotos;
use ServiceBus\TelegramBot\Interaction\TelegramMethod;

/**
 * Get a list of profile pictures for a user.
 *
 * @see https://core.telegram.org/bots/api#getuserprofilephotos
 */
final class GetUserProfilePhotos implements TelegramMethod
{
    /**
     * Unique identifier of the target user.
     *
     * @var UserId
     */
    private $userId;

    /**
     * Sequential number of the first photo to be returned. By default, all photos are returned.
     *
     * @var int
     */
    private $offset;

    /**
     * Limits the number of photos to be retrieved. Values between 1—100 are accepted. Defaults to 100.
     *
     * @var int
     */
    private $limit;

    public static function create(UserId $userId, int $offset = 0, int $limit = 100): self
    {
        $self = new self();

        $self->userId = $userId;
        $self->offset = $offset;
        $self->limit  = $limit;

        return $self;
    }

    public function methodName(): string
    {
        return 'getUserProfilePhotos';
    }

    public function httpRequestMethod(): string
    {
        return 'POST';
    }

    public function requestData(): array
    {
        return [
            'user_id' => $this->userId->toString(),
            'offset'  => $this->offset,
            'limit'   => $this->limit,
        ];
    }

    public function typeClass(): string
    {
        return UserProfilePhotos::class;
    }

    private function __construct()
    {
    }
}
