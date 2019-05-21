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
 * Contains information about a poll.
 *
 * @see https://core.telegram.org/bots/api#poll
 *
 * @property-read string       $id
 * @property-read string       $question
 * @property-read PollOption[] $options
 * @property-read bool         $isClosed
 */
final class Poll
{
    /**
     * Unique poll identifier.
     *
     * @var string
     */
    public $id;

    /**
     * Poll question, 1-255 characters.
     *
     * @var string
     */
    public $question;

    /**
     * List of poll options.
     *
     * @var PollOption[]
     */
    public $options = [];

    /**
     * True, if the poll is closed.
     *
     * @var bool
     */
    public $isClosed = false;
}
