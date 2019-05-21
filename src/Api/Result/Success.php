<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Result;

/**
 * Success execution.
 *
 * @property-read object $type
 */
final class Success implements Result
{
    /**
     * Response type.
     *
     * @var object
     */
    public $type;

    public static function create(object $type): self
    {
        return new self($type);
    }

    /**
     * @param object $type
     */
    private function __construct(object $type)
    {
        $this->type = $type;
    }
}
