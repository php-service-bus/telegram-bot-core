<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Type\User;

use ServiceBus\TelegramBot\Api\Type\Photo\PhotoSize;

/**
 * Represent a user's profile pictures.
 *
 * @see https://core.telegram.org/bots/api#userprofilephotos
 *
 * @psalm-readonly
 */
final class UserProfilePhotos
{
    /**
     * Total number of profile pictures the target user has.
     *
     * @var int
     */
    public $totalCount;

    /**
     * Requested profile pictures (in up to 4 sizes each).
     *
     * @var PhotoSize[]
     */
    public $photos = [];
}
