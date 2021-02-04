<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
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
 * @psalm-immutable
 */
final class UserProfilePhotos
{
    /**
     * Total number of profile pictures the target user has.
     *
     * @psalm-readonly
     *
     * @var int
     */
    public $totalCount;

    /**
     * Requested profile pictures (in up to 4 sizes each).
     *
     * @psalm-readonly
     *
     * @var PhotoSize[]
     */
    public $photos = [];
}
