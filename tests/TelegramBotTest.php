<?php

/**
 * Telegram TelegramBot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Tests;

use PHPUnit\Framework\TestCase;
use ServiceBus\TelegramBot\TelegramBot;

/**
 *
 */
final class TelegramBotTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function emptyUsername(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('TelegramBot username can\'t be empty');

        TelegramBot::create('');
    }

    /**
     * @test
     *
     * @return void
     */
    public function invalidUsername(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('TelegramBot username must end in `TelegramBot` (Like this, for example: TetrisBot or tetris_bot)');

        TelegramBot::create(__METHOD__);
    }

    /**
     * @test
     *
     * @return void
     */
    public function successCreate(): void
    {
        static::assertSame('@DemoBot', TelegramBot::create('DemoBot')->username);
        static::assertSame('@DemoBot', TelegramBot::create('@DemoBot')->username);
    }
}
