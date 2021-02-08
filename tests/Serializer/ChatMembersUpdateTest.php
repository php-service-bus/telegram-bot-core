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
     */
    public function newChatParticipant(): void
    {
        /** @var Update $update */
        $update = (new WrappedSymfonySerializer())->decode(
            jsonDecode(\file_get_contents(__DIR__ . '/stubs/chat_members/newChatParticipant.json')),
            Update::class
        );

        self::assertNotNull($update->message);
        self::assertNotNull($update->message->chat);
        self::assertNotEmpty($update->message->newChatMembers);

        $joinedMembers = JoinedChatMembers::create($update->message->chat, UserCollection::create($update->message->newChatMembers));

        $members = \iterator_to_array($joinedMembers->members);

        self::assertCount(1, $members);

        /** @var User $user */
        $user = \end($members);

        self::assertSame('54324538', $user->id->toString());
        self::assertSame('FirstName', $user->firstName);
        self::assertSame('LastName', $user->lastName);
        self::assertSame('Username', $user->username);
        self::assertFalse($user->isBot);

        self::assertSame('-341054026', $joinedMembers->chat->id->toString());
        self::assertSame('qwertyroot', $joinedMembers->chat->title);
        self::assertTrue($joinedMembers->chat->type->equals(ChatType::group()));
    }

    /**
     * @test
     */
    public function leftChatParticipant(): void
    {
        /** @var Update $update */
        $update = (new WrappedSymfonySerializer())->decode(
            jsonDecode(\file_get_contents(__DIR__ . '/stubs/chat_members/leftChatParticipant.json')),
            Update::class
        );

        self::assertNotNull($update->message);
        self::assertNotNull($update->message->chat);
        self::assertNotNull($update->message->leftChatMember);

        $leftMember = LeftChatMember::create($update->message->chat, $update->message->leftChatMember);

        self::assertSame('54324538', $leftMember->user->id->toString());
        self::assertSame('FirstName', $leftMember->user->firstName);
        self::assertSame('LastName', $leftMember->user->lastName);
        self::assertSame('Username', $leftMember->user->username);
        self::assertFalse($leftMember->user->isBot);
    }
}
