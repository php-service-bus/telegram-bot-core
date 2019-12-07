<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\EntryPoint\Configuration;

/**
 * Receive updates (long pooling) config.
 *
 * @psalm-readonly
 */
final class LongPoolingConfig implements EntryPointConfig
{
    private const DEFAULT_LIMIT = 100;

    private const DEFAULT_INTERVAL = 2000;

    private const MIN_INTERVAL_DELAY = 1000;

    private const MIN_UPDATES_LIMIT = 1;

    private const MAX_UPDATES_LIMIT = 100;

    /**
     * The interval of execution of calls to the Telegram server (in milliseconds).
     *
     * @var int
     */
    public $interval;

    /**
     * Limits the number of updates to be retrieved.
     *
     * @var int
     */
    public $limit;

    /**
     * Identifier of the first update to be returned. Must be greater by one than the highest among the identifiers of
     * previously received updates. By default, updates starting with the earliest unconfirmed update are returned. An
     * update is considered confirmed as soon as getUpdates is called with an offset higher than its update_id. The
     * negative offset can be specified to retrieve updates starting from -offset update from the end of the updates
     * queue. All previous updates will forgotten.
     *
     * @var int|null
     */
    public $offset;

    /**
     * @throws \InvalidArgumentException
     */
    public function __construct(int $interval, int $limit, ?int $offset)
    {
        self::validateInterval($interval);
        self::validateLimit($limit);

        $this->interval = $interval;
        $this->limit    = $limit;
        $this->offset   = $offset;
    }

    /**
     * @return self
     */
    public static function createDefault(): self
    {
        return new self(self::DEFAULT_INTERVAL, self::DEFAULT_LIMIT, null);
    }

    /**
     * Checking the correctness of the update interval.
     *
     * @param int $interval
     *
     * @throws \InvalidArgumentException
     *
     * @return void
     *
     */
    private static function validateInterval(int $interval): void
    {
        if (self::MIN_INTERVAL_DELAY > $interval)
        {
            throw new \InvalidArgumentException(
                \sprintf(
                    'Updates can not be retrieved more than once per "%d" millisecond (specified: %d)',
                    self::MIN_INTERVAL_DELAY,
                    $interval
                )
            );
        }
    }

    /**
     * Checking the correctness of the update limit.
     *
     * @param int $limit
     *
     * @throws \InvalidArgumentException
     *
     * @return void
     *
     */
    private static function validateLimit(int $limit): void
    {
        if (self::MIN_UPDATES_LIMIT > $limit || self::MAX_UPDATES_LIMIT < $limit)
        {
            throw new \InvalidArgumentException(
                \sprintf(
                    'Invalid limits the number of updates to be retrieved (%d). Values between %d—%d are accepted',
                    $limit,
                    self::MIN_UPDATES_LIMIT,
                    self::MAX_UPDATES_LIMIT
                )
            );
        }
    }
}
