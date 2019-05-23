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
use ServiceBus\TelegramBot\TelegramCredentials;

/**
 *
 */
final class TelegramCredentialsTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function emptyToken(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('API token can\'t be empty');

        TelegramCredentials::apiToken('');
    }

    /**
     * @test
     *
     * @return void
     */
    public function invalidToken(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid bot api token (via regular expression "/(\d+)\:[\w\-]+/")');

        TelegramCredentials::apiToken(__METHOD__);
    }

    /**
     * @test
     *
     * @return void
     */
    public function successToken(): void
    {
        static::assertSame(
            '25896951:AAGB5PnXUTW-SuI4CIe742FKcTvPEwP82_o',
            TelegramCredentials::apiToken('25896951:AAGB5PnXUTW-SuI4CIe742FKcTvPEwP82_o')->token
        );
    }
}
