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
 * Contains information about a poll.
 *
 * @see https://core.telegram.org/bots/api#poll
 *
 * @psalm-immutable
 */
final class Poll
{
    /**
     * Unique poll identifier.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $id;

    /**
     * Poll question, 1-255 characters.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $question;

    /**
     * List of poll options.
     *
     * @psalm-readonly
     *
     * @var PollOption[]
     */
    public $options = [];

    /**
     * True, if the poll is closed.
     *
     * @psalm-readonly
     *
     * @var bool
     */
    public $isClosed = false;
}
