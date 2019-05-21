<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Serializer;

define('JSON_ERRORS_MAPPING', [
    \JSON_ERROR_DEPTH                 => 'The maximum stack depth has been exceeded',
    \JSON_ERROR_STATE_MISMATCH        => 'Invalid or malformed JSON',
    \JSON_ERROR_CTRL_CHAR             => 'Control character error, possibly incorrectly encoded',
    \JSON_ERROR_SYNTAX                => 'Syntax error',
    \JSON_ERROR_UTF8                  => 'Malformed UTF-8 characters, possibly incorrectly encoded',
    \JSON_ERROR_RECURSION             => 'One or more recursive references in the value to be encoded',
    \JSON_ERROR_INF_OR_NAN            => 'One or more NAN or INF values in the value to be encoded',
    \JSON_ERROR_UNSUPPORTED_TYPE      => 'A value of a type that cannot be encoded was given',
    \JSON_ERROR_INVALID_PROPERTY_NAME => 'A property name that cannot be encoded was given',
    \JSON_ERROR_UTF16                 => 'Malformed UTF-16 characters, possibly incorrectly encoded',
]);

/**
 * @param string $json
 * @param bool   $assoc
 * @param int    $depth
 * @param int    $options
 *
 * @return array
 */
function jsonDecode(string $json, bool $assoc = false, int $depth = 512, int $options = 0): array
{
    /** Clear last error */
    \json_last_error();

    /** @psalm-var array<string, string|int|float|null> $decoded */
    $decoded = \json_decode($json, $assoc, $depth, $options);

    $lastResultCode = \json_last_error();

    if (\JSON_ERROR_NONE === $lastResultCode)
    {
        return $decoded;
    }

    throw new \RuntimeException(
        \sprintf(
            'JSON unserialize failed: %s',
            (string) (JSON_ERRORS_MAPPING[$lastResultCode] ?? 'Unknown error')
        )
    );
}

/**
 * @param array|object $value
 * @param int          $options
 * @param int          $depth
 *
 * @return string
 */
function jsonEncode($value, int $options = 0, int $depth = 512): string
{
    /** Clear last error */
    \json_last_error();

    $encoded = \json_encode($value, $options, $depth);

    $lastResultCode = \json_last_error();

    if (false !== $encoded && \JSON_ERROR_NONE === $lastResultCode)
    {
        return $encoded;
    }

    throw new \RuntimeException(
        \sprintf(
            'JSON serialize failed: %s',
            (string) (JSON_ERRORS_MAPPING[$lastResultCode] ?? 'Unknown error')
        )
    );
}
