<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types=0);

namespace ServiceBus\TelegramBot\Api\Type;

/**
 * Contains information about the current status of a webhook.
 *
 * @see https://core.telegram.org/bots/api#webhookinfo
 *
 * @psalm-immutable
 */
final class WebhookInfo
{
    /**
     * Webhook URL, may be empty if webhook is not set up.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $url;

    /**
     * True, if a custom certificate was provided for webhook certificate checks.
     *
     * @psalm-readonly
     *
     * @var bool
     */
    public $hasCustomCertificate = false;

    /**
     * Number of updates awaiting delivery.
     *
     * @psalm-readonly
     *
     * @var int
     */
    public $pendingUpdateCount;

    /**
     * Optional. Unix time for the most recent error that happened when trying to deliver an update via webhook.
     *
     * @psalm-readonly
     *
     * @var int|null
     */
    public $lastErrorDate;

    /**
     * Optional. Error message in human-readable format for the most recent error that happened when trying to deliver
     * an update via webhook.
     *
     * @psalm-readonly
     *
     * @var string|null
     */
    public $lastErrorMessage;

    /**
     * Optional. Maximum allowed number of simultaneous HTTPS connections to the webhook for update delivery.
     *
     * @psalm-readonly
     *
     * @var int|null
     */
    public $maxConnections;

    /**
     * Optional. A list of update types the bot is subscribed to. Defaults to all update types.
     *
     * @psalm-readonly
     *
     * @var string[]
     */
    public $allowedUpdates;
}
