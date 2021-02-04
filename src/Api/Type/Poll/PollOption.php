<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 0);

namespace ServiceBus\TelegramBot\Api\Type\Poll;

/**
 * Contains information about one answer option in a poll.
 *
 * @see https://core.telegram.org/bots/api#polloption
 *
 * @psalm-immutable
 */
final class PollOption
{
    /**
     * Option text, 1-100 characters.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $text;

    /**
     * Number of users that voted for this option.
     *
     * @psalm-readonly
     *
     * @var int
     */
    public $voterCount;
}
