<?php /** @noinspection PhpUnhandledExceptionInspection */

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Tests\Serializer;

use function ServiceBus\Common\jsonDecode;
use PHPUnit\Framework\TestCase;
use ServiceBus\TelegramBot\Api\Type\Poll\Poll;
use ServiceBus\TelegramBot\Api\Type\Update;
use ServiceBus\TelegramBot\Serializer\WrappedSymfonySerializer;

/**
 *
 */
final class PollUpdatesTest extends TestCase
{
    /**
     * @test
     */
    public function pollInfo(): void
    {
        /** @var Update $update */
        $update = (new WrappedSymfonySerializer())->decode(
            jsonDecode(\file_get_contents(__DIR__ . '/stubs/polls/vote.json')),
            Update::class
        );

        self::assertNotNull($update->poll);

        /** @var Poll $poll */
        $poll = $update->poll;

        self::assertSame('root', $poll->question);
        self::assertCount(3, $poll->options);
    }
}
