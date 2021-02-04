<?php

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
use ServiceBus\TelegramBot\Api\Type\Chat\JoinedChatMembers;
use ServiceBus\TelegramBot\Api\Type\Chat\LeftChatMember;
use ServiceBus\TelegramBot\Api\Type\Update;
use ServiceBus\TelegramBot\Api\Type\User\User;
use ServiceBus\TelegramBot\Api\Type\User\UserCollection;
use ServiceBus\TelegramBot\Serializer\WrappedSymfonySerializer;

/**
 *
 */
final class ChatMembersUpdateTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     */
    public function newChatParticipant(): void
    {
        /** @var Update $update */
        $update = (new WrappedSymfonySerializer())->decode(
            jsonDecode(\file_get_contents(__DIR__ . '/stubs/chat_members/newChatParticipant.json')),
            Update::class
        );

        static::assertNotNull($update->message);
        static::assertNotNull($update->message->chat);
        static::assertNotEmpty($update->message->newChatMembers);

        $joinedMembers = JoinedChatMembers::create($update->message->chat, UserCollection::create($update->message->newChatMembers));

        $members = \iterator_to_array($joinedMembers->members);

        static::assertCount(1, $members);

        /** @var User $user */
        $user = \end($members);

        static::assertSame('54324538', $user->id->toString());
        static::assertSame('FirstName', $user->firstName);
        static::assertSame('LastName', $user->lastName);
        static::assertSame('Username', $user->username);
        static::assertFalse($user->isBot);

        static::assertSame('-341054026', $joinedMembers->chat->id->toString());
        static::assertSame('qwertyroot', $joinedMembers->chat->title);
        static::assertTrue($joinedMembers->chat->type->equals(ChatType::group()));
    }

    /**
     * @test
     *
     * @return void
     */
    public function leftChatParticipant(): void
    {
        /** @var Update $update */
        $update = (new WrappedSymfonySerializer())->decode(
            jsonDecode(\file_get_contents(__DIR__ . '/stubs/chat_members/leftChatParticipant.json')),
            Update::class
        );

        static::assertNotNull($update->message);
        static::assertNotNull($update->message->chat);
        static::assertNotNull($update->message->leftChatMember);

        $leftMember = LeftChatMember::create($update->message->chat, $update->message->leftChatMember);

        static::assertSame('54324538', $leftMember->user->id->toString());
        static::assertSame('FirstName', $leftMember->user->firstName);
        static::assertSame('LastName', $leftMember->user->lastName);
        static::assertSame('Username', $leftMember->user->username);
        static::assertFalse($leftMember->user->isBot);
    }
}
