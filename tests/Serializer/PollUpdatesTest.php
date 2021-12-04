<?php

/** @noinspection PhpUnhandledExceptionInspection */

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types=1);

namespace ServiceBus\TelegramBot\Tests\Serializer;

use ServiceBus\TelegramBot\Hydrator\TelegramHydrator;
use PHPUnit\Framework\TestCase;
use ServiceBus\TelegramBot\Api\Type\Poll\Poll;
use ServiceBus\TelegramBot\Api\Type\Update;
use function ServiceBus\Common\jsonDecode;

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
        $update = TelegramHydrator::default()->handle(
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
