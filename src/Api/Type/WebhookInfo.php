<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Type;

/**
 * Contains information about the current status of a webhook.
 *
 * @see https://core.telegram.org/bots/api#webhookinfo
 *
 * @property-read string      $url
 * @property-read bool        $hasCustomCertificate
 * @property-read int         $pendingUpdateCount
 * @property-read int|null    $lastErrorDate
 * @property-read string|null $lastErrorMessage
 * @property-read int|null    $maxConnections
 * @property-read string[]    $allowedUpdates
 */
final class WebhookInfo
{
    /**
     * Webhook URL, may be empty if webhook is not set up.
     *
     * @var string
     */
    public $url;

    /**
     * True, if a custom certificate was provided for webhook certificate checks.
     *
     * @var bool
     */
    public $hasCustomCertificate = false;

    /**
     * Number of updates awaiting delivery.
     *
     * @var int
     */
    public $pendingUpdateCount;

    /**
     * Optional. Unix time for the most recent error that happened when trying to deliver an update via webhook.
     *
     * @var int|null
     */
    public $lastErrorDate;

    /**
     * Optional. Error message in human-readable format for the most recent error that happened when trying to deliver
     * an update via webhook.
     *
     * @var string|null
     */
    public $lastErrorMessage;

    /**
     * Optional. Maximum allowed number of simultaneous HTTPS connections to the webhook for update delivery.
     *
     * @var int|null
     */
    public $maxConnections;

    /**
     * Optional. A list of update types the bot is subscribed to. Defaults to all update types.
     *
     * @var string[]
     */
    public $allowedUpdates;
}
