<?php

/**
 * Telegram TelegramBot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
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
     */
    public function emptyUsername(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('TelegramBot username can\'t be empty');

        new TelegramBot('');
    }

    /**
     * @test
     */
    public function invalidUsername(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('TelegramBot username must end in `TelegramBot` (Like this, for example: TetrisBot or tetris_bot)');

        new  TelegramBot(__METHOD__);
    }

    /**
     * @test
     */
    public function successCreate(): void
    {
        self::assertSame('@DemoBot', (new TelegramBot('DemoBot'))->username);
        self::assertSame('@DemoBot', (new TelegramBot('@DemoBot'))->username);
    }
}
