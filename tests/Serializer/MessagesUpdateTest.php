<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Tests\Serializer;

use PHPUnit\Framework\TestCase;
use ServiceBus\TelegramBot\Api\Type\Chat\ChatType;
use ServiceBus\TelegramBot\Api\Type\Common\UnixTime;
use ServiceBus\TelegramBot\Api\Type\Message\Message;
use ServiceBus\TelegramBot\Api\Type\Update;
use ServiceBus\TelegramBot\Api\Type\User\User;
use ServiceBus\TelegramBot\Serializer\SymfonySerializer;
use function ServiceBus\Common\jsonDecode;

/**
 *
 */
final class MessagesUpdateTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function messageReceived(): void
    {
        /** @var Update $update */
        $update = (new SymfonySerializer())->decode(
            jsonDecode(\file_get_contents(__DIR__ . '/stubs/messages/messageReceived.json')),
            Update::class
        );

        static::assertNotNull($update->message);
        static::assertNotNull($update->message->from);
        static::assertNotNull($update->message->chat);

        /** @var Message $message */
        $message = $update->message;
        /** @var User $user */
        $user = $message->from;

        $chat = $message->chat;

        static::assertSame('3', $message->messageId->toString());
        static::assertInstanceOf(UnixTime::class, $message->date);
        static::assertSame('message text', $message->text);

        static::assertSame('288825898', $user->id->toString());
        static::assertSame('Maksim', $user->firstName);
        static::assertSame('Masiukevich', $user->lastName);
        static::assertSame('desper1989', $user->username);
        static::assertFalse($user->isBot);

        static::assertSame('-341054026', $chat->id->toString());
        static::assertSame('qwertyroot', $chat->title);
        static::assertTrue($chat->type->equals(ChatType::group()));
    }
}
