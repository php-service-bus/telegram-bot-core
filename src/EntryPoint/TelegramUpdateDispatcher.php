<?php

/**
 * Telegram TelegramBot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\EntryPoint;

use Amp\Promise;
use Amp\Success;
use ServiceBus\TelegramBot\Api\Type\Update;

/**
 *
 */
final class TelegramUpdateDispatcher
{
    public function dispatch(Update $update): Promise
    {
        print_r($update);

        return new Success();
    }
}
