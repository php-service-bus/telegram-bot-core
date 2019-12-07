<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Type\Poll;

/**
 * Contains information about one answer option in a poll.
 *
 * @see https://core.telegram.org/bots/api#polloption
 *
 * @psalm-readonly
 */
final class PollOption
{
    /**
     * Option text, 1-100 characters.
     *
     * @var string
     */
    public $text;

    /**
     * Number of users that voted for this option.
     *
     * @var int
     */
    public $voterCount;
}
