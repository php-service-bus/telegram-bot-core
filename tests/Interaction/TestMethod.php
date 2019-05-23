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

use ServiceBus\TelegramBot\Api\Type\User\User;
use ServiceBus\TelegramBot\Interaction\TelegramMethod;
use Symfony\Component\Validator\Constraints as Assert;

/**
 *
 */
final class TestMethod implements TelegramMethod
{
    /**
     * @Assert\NotBlank()
     *
     * @var string
     */
    private $id;

    /**
     * @param string $id
     */
    public function __construct(string $id = '123')
    {
        $this->id = $id;
    }

    /**
     * {@inheritdoc}
     */
    public function methodName(): string
    {
        return 'TestMethod';
    }

    /**
     * {@inheritdoc}
     */
    public function httpRequestMethod(): string
    {
        return 'POST';
    }

    /**
     * {@inheritdoc}
     */
    public function requestData(): array
    {
        return [
            'id' => $this->id,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function typeClass(): string
    {
        return User::class;
    }
}
