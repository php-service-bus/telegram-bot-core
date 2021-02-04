<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 0);

namespace ServiceBus\TelegramBot\Api\Method\File;

use ServiceBus\TelegramBot\Api\Type\File\FileInfo;
use ServiceBus\TelegramBot\Interaction\TelegramMethod;

/**
 * Use this method to get basic info about a file and prepare it for downloading. For the moment, bots can download
 * files of up to 20MB in size. On success, a File object is returned. The file can then be downloaded via the link.
 */
final class GetFile implements TelegramMethod
{
    /**
     * File identifier to get info about.
     *
     * @var string
     */
    private $fileId;

    public static function create(string $fileId): self
    {
        $self = new self();

        $self->fileId = $fileId;

        return $self;
    }

    public function methodName(): string
    {
        return 'getFile';
    }

    public function httpRequestMethod(): string
    {
        return 'POST';
    }

    public function requestData(): array
    {
        return [
            'file_id' => $this->fileId,
        ];
    }

    public function typeClass(): string
    {
        return FileInfo::class;
    }

    private function __construct()
    {
    }
}
