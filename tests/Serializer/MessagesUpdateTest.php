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
use ServiceBus\TelegramBot\Api\Type\Chat\ChatType;
use ServiceBus\TelegramBot\Api\Type\Common\UnixTime;
use ServiceBus\TelegramBot\Api\Type\Message\Message;
use ServiceBus\TelegramBot\Api\Type\Update;
use ServiceBus\TelegramBot\Api\Type\User\User;
use ServiceBus\TelegramBot\Serializer\WrappedSymfonySerializer;

/**
 *
 */
final class MessagesUpdateTest extends TestCase
{
    /**
     * @test
     */
    public function messageReceived(): void
    {
        /** @var Update $update */
        $update = (new WrappedSymfonySerializer())->decode(
            jsonDecode(\file_get_contents(__DIR__ . '/stubs/messages/messageReceived.json')),
            Update::class
        );

        self::assertNotNull($update->message);
        self::assertNotNull($update->message->from);
        self::assertNotNull($update->message->chat);

        /** @var Message $message */
        $message = $update->message;
        /** @var User $user */
        $user = $message->from;

        $chat = $message->chat;

        self::assertSame('3', $message->messageId->toString());
        self::assertInstanceOf(UnixTime::class, $message->date);
        self::assertSame('message text', $message->text);

        self::assertSame('288825898', $user->id->toString());
        self::assertSame('Maksim', $user->firstName);
        self::assertSame('Masiukevich', $user->lastName);
        self::assertSame('desper1989', $user->username);
        self::assertFalse($user->isBot);

        self::assertSame('-341054026', $chat->id->toString());
        self::assertSame('qwertyroot', $chat->title);
        self::assertTrue($chat->type->equals(ChatType::group()));
    }
}
