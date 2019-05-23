<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Tests\EntryPoint\Configuration;

use PHPUnit\Framework\TestCase;
use ServiceBus\TelegramBot\EntryPoint\Configuration\LongPoolingConfig;

/**
 *
 */
final class LongPoolingConfigTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function createDefault(): void
    {
        $config = LongPoolingConfig::createDefault();

        static::assertSame(100, $config->limit);
        static::assertSame(2000, $config->interval);
        static::assertNull($config->offset);
    }

    /**
     * @test
     *
     * @return void
     */
    public function withInvalidInterval(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Updates can not be retrieved more than once per "1000" millisecond (specified: 50)');

        LongPoolingConfig::create(50, 100, null);
    }

    /**
     * @test
     *
     * @return void
     */
    public function withInvalidLimit(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid limits the number of updates to be retrieved (-100). Values between 1—100 are accepted');

        LongPoolingConfig::create(5000, -100, null);
    }
}
