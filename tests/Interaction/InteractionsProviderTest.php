<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Tests\Interaction;

use Amp\Loop;
use PHPUnit\Framework\TestCase;
use ServiceBus\TelegramBot\Api\Method\File\DownloadFile;
use ServiceBus\TelegramBot\Api\Type\User\User;
use ServiceBus\TelegramBot\Interaction\InteractionsProvider;
use ServiceBus\TelegramBot\Interaction\Result\Fail;
use ServiceBus\TelegramBot\Interaction\Result\Success;
use ServiceBus\TelegramBot\TelegramCredentials;

/**
 *
 */
final class InteractionsProviderTest extends TestCase
{
    /**
     * @var TelegramCredentials
     */
    private $credentials;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->credentials = TelegramCredentials::apiToken('25896951:AAGB5PnXUTW-SuI4CIe742FKcTvPEwP82_o');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->credentials);

        Loop::stop();
    }

    /**
     * @test
     *
     * @return void
     */
    public function unknownMethod(): void
    {
        Loop::run(
            function(): \Generator
            {
                /** @var \ServiceBus\TelegramBot\Interaction\Result\Fail $result */
                $result = yield (new InteractionsProvider(TestHttpClient::create('{}', 404)))->call(
                    new TestMethod(),
                    $this->credentials
                );

                static::assertInstanceOf(Fail::class, $result);
                static::assertSame('Method TestMethod not exists', $result->errorMessage);
            }
        );
    }

    /**
     * @test
     *
     * @return void
     */
    public function validationFailed(): void
    {
        Loop::run(
            function(): \Generator
            {
                /** @var \ServiceBus\TelegramBot\Interaction\Result\Fail $result */
                $result = yield (new InteractionsProvider(TestHttpClient::create('{}', 404)))->call(
                    new TestMethod(''),
                    $this->credentials
                );

                static::assertInstanceOf(Fail::class, $result);
                static::assertSame('Validation failed', $result->errorMessage);
            }
        );
    }

    /**
     * @test
     *
     * @return void
     */
    public function internalError(): void
    {
        Loop::run(
            function(): \Generator
            {
                /** @var \ServiceBus\TelegramBot\Interaction\Result\Fail $result */
                $result = yield (new InteractionsProvider(TestHttpClient::create('{}', 500)))->call(
                    new TestMethod(),
                    $this->credentials
                );

                static::assertInstanceOf(Fail::class, $result);
                static::assertSame('Incorrect server response code: 500', $result->errorMessage);
            }
        );
    }

    /**
     * @test
     *
     * @return void
     */
    public function incorrectResponsePayload(): void
    {
        Loop::run(
            function(): \Generator
            {
                /** @var \ServiceBus\TelegramBot\Interaction\Result\Fail $result */
                $result = yield (new InteractionsProvider(TestHttpClient::create('{}', 200)))->call(
                    new TestMethod(),
                    $this->credentials
                );

                static::assertInstanceOf(Fail::class, $result);
                static::assertSame('Incorrect response payload', $result->errorMessage);
            }
        );
    }

    /**
     * @test
     *
     * @return void
     */
    public function successRequest(): void
    {
        Loop::run(
            function(): \Generator
            {
                $expectedResponse = '{"ok":true,"result":{"id":1,"is_bot":true,"first_name":"First","last_name":"","username":"User"}}';

                /** @var \ServiceBus\TelegramBot\Interaction\Result\Success $result */
                $result = yield (new InteractionsProvider(TestHttpClient::create($expectedResponse, 200)))->call(
                    new TestMethod(),
                    $this->credentials
                );

                static::assertInstanceOf(Success::class, $result);

                /** @var User $type */
                $type = $result->type;

                static::assertSame('1', $type->id->toString());
            }
        );
    }

    /**
     * @test
     *
     * @return void
     */
    public function failedDownload(): void
    {
        Loop::run(
            function(): \Generator
            {
                /** @var \ServiceBus\TelegramBot\Interaction\Result\Fail $result */
                $result = yield (new InteractionsProvider(TestHttpClient::failed('fail message')))->call(
                    DownloadFile::create('', '', ''),
                    $this->credentials
                );

                static::assertInstanceOf(Fail::class, $result);
                static::assertSame('fail message', $result->errorMessage);
            }
        );
    }

    /**
     * @test
     *
     * @return void
     */
    public function successDownload(): void
    {
        Loop::run(
            function(): \Generator
            {
                /** @var \ServiceBus\TelegramBot\Interaction\Result\Success $result */
                $result = yield (new InteractionsProvider(TestHttpClient::create('', 200)))->call(
                    DownloadFile::create('', '', ''),
                    $this->credentials
                );

                static::assertInstanceOf(Success::class, $result);
            }
        );
    }
}
