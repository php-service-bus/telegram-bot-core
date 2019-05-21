<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\Telegram\Bot\Tests\Types\Common;

use PHPUnit\Framework\TestCase;
use ServiceBus\TelegramBot\Api\Type\Common\UnixTime;

/**
 *
 */
final class UnixTimeTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function asDateTime(): void
    {
        $unixTime = new UnixTime(1558010192);

        static::assertSame(
            '2019:05:16 12:36:32',
            $unixTime->toDateTime()->format('Y:m:d H:i:s')
        );

        static::assertSame(1558010192, $unixTime->extract());
    }
}
