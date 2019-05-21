<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Api\Method\File;

use ServiceBus\TelegramBot\Api\Method\BotCommand;
use ServiceBus\TelegramBot\Api\Type\File\FileInfo;

/**
 * Use this method to get basic info about a file and prepare it for downloading. For the moment, bots can download
 * files of up to 20MB in size. On success, a File object is returned. The file can then be downloaded via the link.
 */
final class GetFile implements BotCommand
{
    /**
     * File identifier to get info about.
     *
     * @var string
     */
    private $fileId;

    /**
     * @param string $fileId
     *
     * @return self
     */
    public static function create(string $fileId): self
    {
        $self = new self();

        $self->fileId = $fileId;

        return $self;
    }

    /**
     * {@inheritdoc}
     */
    public function methodName(): string
    {
        return 'getFile';
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
            'file_id' => $this->fileId,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function typeClass(): string
    {
        return FileInfo::class;
    }

    private function __construct()
    {
    }
}
