<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Method;

use ServiceBus\TelegramBot\Api\Type\UpdateCollection;
use ServiceBus\TelegramBot\Interaction\TelegramMethod;

/**
 * Use this method to receive incoming updates using long polling. An Array of Update objects is returned.
 *
 * @see https://core.telegram.org/bots/api#getupdates
 */
final class GetUpdates implements TelegramMethod
{
    /**
     * Identifier of the first update to be returned. Must be greater by one than the highest among the identifiers of
     * previously received updates. By default, updates starting with the earliest unconfirmed update are returned. An
     * update is considered confirmed as soon as getUpdates is called with an offset higher than its update_id. The
     * negative offset can be specified to retrieve updates starting from -offset update from the end of the updates
     * queue. All previous updates will forgotten.
     *
     * @var int|null
     */
    private $offset;

    /**
     * Limits the number of updates to be retrieved. Values between 1—100 are accepted. Defaults to 100.
     *
     * @var int
     */
    private $limit;

    /**
     * Timeout in seconds for long polling. Defaults to 0, i.e. usual short polling. Should be positive, short polling
     * should be used for testing purposes only.
     *
     * @var int|null
     */
    private $timeout;

    /**
     * List the types of updates you want your bot to receive. For example, specify [“message”, “edited_channel_post”,
     * “callback_query”] to only receive updates of these types. See Update for a complete list of available update
     * types. Specify an empty list to receive all updates regardless of type (default). If not specified, the previous
     * setting will be used.
     *
     * Please note that this parameter doesn't affect updates created before the call to the getUpdates, so unwanted
     * updates may be received for a short period of time.
     *
     * @var string[]
     */
    private $allowedUpdates;

    public static function create(int $offset = null, int $limit = null): self
    {
        $self = new self();

        $self->offset = $offset;
        $self->limit  = $limit ?? 100;

        return $self;
    }

    public function withTimeout(int $timeout): void
    {
        $this->timeout = $timeout;
    }

    /**
     * @psalm-param array<string, string> $allowedUpdates
     */
    public function allowUpdates(array $allowedUpdates): void
    {
        $this->allowedUpdates = $allowedUpdates;
    }

    public function methodName(): string
    {
        return 'getUpdates';
    }

    public function httpRequestMethod(): string
    {
        return 'GET';
    }

    public function requestData(): array
    {
        return \array_filter(
            [
                'offset'          => $this->offset,
                'limit'           => $this->limit,
                'timeout'         => $this->timeout,
                'allowed_updates' => $this->allowedUpdates,
            ]
        );
    }

    public function typeClass(): string
    {
        return UpdateCollection::class;
    }

    private function __construct()
    {
    }
}
