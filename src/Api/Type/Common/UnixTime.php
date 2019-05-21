<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

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

    /**
     * @param int $value
     */
    public function __construct(int $value)
    {
        $this->value = $value;
    }

    /**
     * @noinspection PhpDocMissingThrowsInspection
     *
     * @param \DateTimeZone|null $timeZone
     *
     * @return \DateTimeImmutable
     */
    public function toDateTime(\DateTimeZone $timeZone = null): \DateTimeImmutable
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        return new \DateTimeImmutable(\sprintf('@%d', $this->value), $timeZone);
    }

    /**
     * Receive a unix time.
     *
     * @return int
     */
    public function extract(): int
    {
        return $this->value;
    }
}
