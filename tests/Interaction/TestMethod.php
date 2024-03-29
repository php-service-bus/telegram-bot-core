<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types=1);

namespace ServiceBus\TelegramBot\Tests\Interaction;

use ServiceBus\TelegramBot\Api\Type\User\User;
use ServiceBus\TelegramBot\Interaction\TelegramMethod;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 */
final class TestMethod implements TelegramMethod
{
    /**
     * @var string
     */
    #[Assert\NotBlank]
    private $id;

    public function __construct(string $id = '123')
    {
        $this->id = $id;
    }

    public function methodName(): string
    {
        return 'TestMethod';
    }

    public function httpRequestMethod(): string
    {
        return 'POST';
    }

    public function requestData(): array
    {
        return [
            'id' => $this->id,
        ];
    }

    public function typeClass(): string
    {
        return User::class;
    }
}
