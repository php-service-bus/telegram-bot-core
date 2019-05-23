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
use ServiceBus\TelegramBot\EntryPoint\Configuration\WebHooksConfig;

/**
 *
 */
final class WebHooksConfigTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function emptyDomain(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Callback URL must be specifier');

        WebHooksConfig::create('');
    }

    /**
     * @test
     *
     * @return void
     */
    public function invalidDomain(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Can\'at parse callback URL address');

        WebHooksConfig::create('///example.org:80');
    }

    /**
     * @test
     *
     * @return void
     */
    public function unsupportedScheme(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Callback URL scheme can only be "https"');

        WebHooksConfig::create('http://google.com');
    }

    /**
     * @test
     *
     * @return void
     */
    public function unsupportedDomainPort(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Incorrect callback URL port specified ("1331"). Available choices: 443, 80, 88, 8443');

        WebHooksConfig::create('https://google.com:1331');
    }

    /**
     * @test
     *
     * @return void
     */
    public function unExistsCertificateFilePath(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The specified certificate file ("~/abube.gif") was not found');

        WebHooksConfig::create('https://google.com', null, null, '~/abube.gif');
    }

    /**
     * @test
     *
     * @return void
     */
    public function emptyListenHost(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Listen host can\'t be empty');

        WebHooksConfig::create('https://google.com', '');
    }

    /**
     * @test
     *
     * @return void
     */
    public function invalidListenPort(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Listen port must be greater than zero');

        WebHooksConfig::create('https://google.com', '[::]', -100);
    }
}
