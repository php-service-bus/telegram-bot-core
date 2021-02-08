<?php /** @noinspection PhpUnhandledExceptionInspection */

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
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

    protected function setUp(): void
    {
        parent::setUp();

        $this->credentials = new TelegramCredentials('25896951:AAGB5PnXUTW-SuI4CIe742FKcTvPEwP82_o');
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->credentials);

        Loop::stop();
    }

    /**
     * @test
     */
    public function unknownMethod(): void
    {
        Loop::run(
            function (): \Generator
            {
                /** @var \ServiceBus\TelegramBot\Interaction\Result\Fail $result */
                $result = yield (new InteractionsProvider(TestHttpClient::create('{}', 404)))->call(
                    new TestMethod(),
                    $this->credentials
                );

                self::assertInstanceOf(Fail::class, $result);
                self::assertSame('Method TestMethod not exists', $result->errorMessage);
            }
        );
    }

    /**
     * @test
     */
    public function validationFailed(): void
    {
        Loop::run(
            function (): \Generator
            {
                /** @var \ServiceBus\TelegramBot\Interaction\Result\Fail $result */
                $result = yield (new InteractionsProvider(TestHttpClient::create('{}', 404)))->call(
                    new TestMethod(''),
                    $this->credentials
                );

                self::assertInstanceOf(Fail::class, $result);
                self::assertSame('Validation failed', $result->errorMessage);

                Loop::stop();
            }
        );
    }

    /**
     * @test
     */
    public function internalError(): void
    {
        Loop::run(
            function (): \Generator
            {
                /** @var \ServiceBus\TelegramBot\Interaction\Result\Fail $result */
                $result = yield (new InteractionsProvider(TestHttpClient::create('{}', 500)))->call(
                    new TestMethod(),
                    $this->credentials
                );

                self::assertInstanceOf(Fail::class, $result);
                self::assertSame('Incorrect server response code: 500', $result->errorMessage);

                Loop::stop();
            }
        );
    }

    /**
     * @test
     */
    public function incorrectResponsePayload(): void
    {
        Loop::run(
            function (): \Generator
            {
                /** @var \ServiceBus\TelegramBot\Interaction\Result\Fail $result */
                $result = yield (new InteractionsProvider(TestHttpClient::create('{}', 200)))->call(
                    new TestMethod(),
                    $this->credentials
                );

                self::assertInstanceOf(Fail::class, $result);
                self::assertSame('Incorrect response payload', $result->errorMessage);

                Loop::stop();
            }
        );
    }

    /**
     * @test
     */
    public function successRequest(): void
    {
        Loop::run(
            function (): \Generator
            {
                $expectedResponse = '{"ok":true,"result":{"id":1,"is_bot":true,"first_name":"First","last_name":"","username":"User"}}';

                /** @var \ServiceBus\TelegramBot\Interaction\Result\Success $result */
                $result = yield (new InteractionsProvider(TestHttpClient::create($expectedResponse, 200)))->call(
                    new TestMethod(),
                    $this->credentials
                );

                self::assertInstanceOf(Success::class, $result);

                /** @var User $type */
                $type = $result->type;

                self::assertSame('1', $type->id->toString());

                Loop::stop();
            }
        );
    }

    /**
     * @test
     */
    public function failedDownload(): void
    {
        Loop::run(
            function (): \Generator
            {
                /** @var \ServiceBus\TelegramBot\Interaction\Result\Fail $result */
                $result = yield (new InteractionsProvider(TestHttpClient::failed('fail message')))->call(
                    DownloadFile::create('', '', ''),
                    $this->credentials
                );

                self::assertInstanceOf(Fail::class, $result);
                self::assertSame('fail message', $result->errorMessage);

                Loop::stop();
            }
        );
    }

    /**
     * @test
     */
    public function successDownload(): void
    {
        Loop::run(
            function (): \Generator
            {
                /** @var \ServiceBus\TelegramBot\Interaction\Result\Success $result */
                $result = yield (new InteractionsProvider(TestHttpClient::create('', 200)))->call(
                    DownloadFile::create('', '', ''),
                    $this->credentials
                );

                self::assertInstanceOf(Success::class, $result);

                Loop::stop();
            }
        );
    }
}
