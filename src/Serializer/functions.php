<?php

/**
 * Telegram TelegramBot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Serializer;

/**
 * @param string $json
 * @param bool   $assoc
 *
 * @return array
 *
 * @throws \RuntimeException
 */
function jsonDecode(string $json, bool $assoc = false): array
{
    try
    {
        /**
         * @psalm-var array<string, string|int|float|null> $decoded
         * @var array $decoded
         */
        $decoded = \json_decode($json, $assoc, 512, \JSON_THROW_ON_ERROR);

        return $decoded;
    }
    catch(\Throwable $throwable)
    {
        throw new \RuntimeException($throwable->getMessage(), (int) $throwable->getCode(), $throwable);
    }
}

/**
 * @param array|object $value
 *
 * @return string
 *
 * @throws \RuntimeException
 */
function jsonEncode($value): string
{
    try
    {
        /** @var string $encoded */
        $encoded = \json_encode($value, \JSON_THROW_ON_ERROR | \JSON_UNESCAPED_SLASHES | \JSON_UNESCAPED_UNICODE);

        return $encoded;
    }
    catch(\Throwable $throwable)
    {
        throw new \RuntimeException($throwable->getMessage(), (int) $throwable->getCode(), $throwable);
    }
}
