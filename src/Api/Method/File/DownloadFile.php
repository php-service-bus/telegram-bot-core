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

use ServiceBus\TelegramBot\Api\Type\SimpleSuccessResponse;
use ServiceBus\TelegramBot\Interaction\TelegramMethod;

/**
 * Download specified file.
 *
 * @psalm-immutable
 */
final class DownloadFile implements TelegramMethod
{
    /**
     * Prepared file path.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $filePath;

    /**
     * Destination directory.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $toDirectory;

    /**
     * Expected file name.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $withName;

    public static function create(string $filePath, string $toDirectory, string $withName): self
    {
        return new self($filePath, $toDirectory, $withName);
    }

    public function methodName(): string
    {
        return '';
    }

    public function httpRequestMethod(): string
    {
        return '';
    }

    public function requestData(): array
    {
        return [];
    }

    public function typeClass(): string
    {
        return SimpleSuccessResponse::class;
    }

    private function __construct(string $filePath, string $toDirectory, string $withName)
    {
        $this->filePath    = $filePath;
        $this->toDirectory = $toDirectory;
        $this->withName    = $withName;
    }
}
