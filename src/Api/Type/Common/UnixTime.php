<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types=0);

namespace ServiceBus\TelegramBot\Api\Type\Common;

/**
 * Unix time.
 */
final class UnixTime
{
    /**
     * @var int
     */
    private $value;

    public function __construct(int $value)
    {
        $this->value = $value;
    }

    public function toDateTime(\DateTimeZone $timeZone = null): \DateTimeImmutable
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        return new \DateTimeImmutable(\sprintf('@%d', $this->value), $timeZone);
    }

    public function extract(): int
    {
        return $this->value;
    }
}
