<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\EntryPoint\Updater;

use Amp\Promise;
use ServiceBus\TelegramBot\EntryPoint\Configuration\EntryPointConfig;
use ServiceBus\TelegramBot\Interaction\InteractionsProvider;
use ServiceBus\TelegramBot\TelegramCredentials;

/**
 * Receive updates.
 *
 * @internal
 */
interface Updater
{
    /**
     * @param InteractionsProvider $interactionsProvider
     * @param TelegramCredentials  $credentials
     * @param EntryPointConfig     $config
     *
     * @throws \LogicException Incorrect config passed
     *
     * @return Promise
     *
     */
    public function run(
        InteractionsProvider $interactionsProvider,
        TelegramCredentials $credentials,
        EntryPointConfig $config
    ): Promise;

    /**
     * @return Promise
     */
    public function stop(): Promise;
}
