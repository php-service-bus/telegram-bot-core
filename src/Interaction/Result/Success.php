<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 0);

namespace ServiceBus\TelegramBot\Interaction\Result;

/**
 * Success execution.
 *
 * @psalm-immutable
 */
final class Success implements Result
{
    /**
     * Response type.
     *
     * @psalm-readonly
     *
     * @var object
     */
    public $type;

    public static function create(object $type): self
    {
        return new self($type);
    }

    private function __construct(object $type)
    {
        $this->type = $type;
    }
}
