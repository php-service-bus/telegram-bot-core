<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Method\Chat;

use ServiceBus\TelegramBot\Api\Type\Enum;

/**
 * Type of action to broadcast.
 */
final class BroadcastType implements Enum
{
    private const TYPING            = 'typing';

    private const UPLOAD_PHOTO      = 'upload_photo';

    private const RECORD_VIDEO      = 'record_video';

    private const UPLOAD_VIDEO      = 'upload_video';

    private const RECORD_AUDIO      = 'record_audio';

    private const UPLOAD_AUDIO      = 'upload_audio';

    private const UPLOAD_DOCUMENT   = 'upload_document';

    private const FIND_LOCATION     = 'find_location';

    private const RECORD_VIDEO_NOTE = 'record_video_note';

    private const UPLOAD_VIDEO_NOTE = 'upload_video_note';

    private const LIST              = [
        self::TYPING,
        self::UPLOAD_PHOTO,
        self::RECORD_VIDEO,
        self::UPLOAD_VIDEO,
        self::RECORD_AUDIO,
        self::UPLOAD_AUDIO,
        self::UPLOAD_DOCUMENT,
        self::FIND_LOCATION,
        self::RECORD_VIDEO_NOTE,
        self::UPLOAD_VIDEO_NOTE,
    ];

    /**
     * @var string
     */
    private $value;

    /**
     * {@inheritdoc}
     */
    public static function create(string $value): self
    {
        if (false === \in_array($value, self::LIST, true))
        {
            throw new \InvalidArgumentException(\sprintf('Incorrect broadcast type: %s', $value));
        }

        return new self($value);
    }

    /**
     * {@inheritdoc}
     */
    public function toString(): string
    {
        return $this->value;
    }

    /**
     * @param string $value
     */
    private function __construct(string $value)
    {
        $this->value = $value;
    }
}
