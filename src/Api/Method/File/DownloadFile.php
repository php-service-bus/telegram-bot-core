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
use ServiceBus\TelegramBot\Api\Type\SimpleSuccessResponse;

/**
 * Download specified file.
 *
 * @property-read string $filePath
 * @property-read string $toDirectory
 * @property-read string $withName
 */
final class DownloadFile implements BotCommand
{
    /**
     * Prepared file path.
     *
     * @var string
     */
    public $filePath;

    /**
     * Destination directory.
     *
     * @var string
     */
    public $toDirectory;

    /**
     * Expected file name.
     *
     * @var string
     */
    public $withName;

    /**
     * @param string $filePath
     * @param string $toDirectory
     * @param string $withName
     *
     * @return self
     */
    public static function create(string $filePath, string $toDirectory, string $withName): self
    {
        return new self($filePath, $toDirectory, $withName);
    }

    /**
     * {@inheritdoc}
     */
    public function methodName(): string
    {
        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function httpRequestMethod(): string
    {
        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function requestData(): array
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function typeClass(): string
    {
        return SimpleSuccessResponse::class;
    }

    /**
     * @param string $filePath
     * @param string $toDirectory
     * @param string $withName
     */
    private function __construct(string $filePath, string $toDirectory, string $withName)
    {
        $this->filePath    = $filePath;
        $this->toDirectory = $toDirectory;
        $this->withName    = $withName;
    }
}
