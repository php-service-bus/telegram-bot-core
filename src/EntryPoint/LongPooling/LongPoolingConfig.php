<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\EntryPoint\LongPooling;

/**
 * Receive updates (long pooling) config.
 *
 * @property-read int $interval
 * @property-read int $limit
 */
final class LongPoolingConfig
{
    private const DEFAULT_LIMIT    = 10;

    private const DEFAULT_INTERVAL = 2000;

    private const MIN_INTERVAL_DELAY = 1000;

    private const MIN_UPDATES_LIMIT  = 1;

    private const MAX_UPDATES_LIMIT  = 100;

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
     * @param int $interval
     * @param int $limit
     *
     * @throws \InvalidArgumentException
     *
     * @return self
     *
     */
    public static function create(int $interval, int $limit): self
    {
        self::validateInterval($interval);
        self::validateLimit($limit);

        return new self($interval, $limit);
    }

    /**
     * @return self
     */
    public static function createDefault(): self
    {
        return new self(self::DEFAULT_INTERVAL, self::DEFAULT_LIMIT);
    }

    /**
     * @param int $interval
     * @param int $limit
     */
    private function __construct(int $interval, int $limit)
    {
        $this->interval = $interval;
        $this->limit    = $limit;
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
