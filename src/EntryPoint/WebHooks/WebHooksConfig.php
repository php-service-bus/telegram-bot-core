<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\EntryPoint\WebHooks;

/**
 * Webhooks configuration.
 *
 * @property-read string      $listenHost
 * @property-read int         $listenPort
 * @property-read string      $callbackUrl
 * @property-read string|null $certificateFilePath
 */
final class WebHooksConfig
{
    private const SUPPORTED_NOTIFICATION_URL_PORTS = [443, 80, 88, 8443];

    private const DEFAULT_LISTEN_HOST = '[::]';

    private const DEFAULT_LISTEN_PORT = 1331;

    /**
     * WebServer listen host.
     *
     * @var string
     */
    public $listenHost;

    /**
     * WebServer listen port.
     *
     * @var int
     */
    public $listenPort;

    /**
     * Notifications callback URL.
     *
     * @var string
     */
    public $callbackUrl;

    /**
     * Notifications callback URL certificate
     * Absolute path to a self-signed ssl certificate.
     *
     * @see https://core.telegram.org/bots/self-signed
     * @see https://letsencrypt.org/getting-started/
     *
     * @var string|null
     */
    public $certificateFilePath;

    /**
     * @param string      $callbackUrl
     * @param string      $listenHost
     * @param int         $listenPort
     * @param string|null $certificateFilePath
     *
     * @throws \InvalidArgumentException Incorrect callback url
     * @throws \InvalidArgumentException Incorrect listening host
     * @throws \InvalidArgumentException Incorrect listening port
     * @throws \InvalidArgumentException Incorrect certificate file
     *
     * @return self
     *
     */
    public static function create(
        string $callbackUrl,
        string $listenHost = self::DEFAULT_LISTEN_HOST,
        int $listenPort = self::DEFAULT_LISTEN_PORT,
        ?string $certificateFilePath = null
    ): self {
        self::validateCallbackUrl($callbackUrl);

        if (null !== $certificateFilePath)
        {
            self::validateSslCertificateFilePath($certificateFilePath);
        }

        if ('' === $listenHost)
        {
            throw new \InvalidArgumentException('Listen host can\'t be empty');
        }

        if (0 >= $listenPort)
        {
            throw new \InvalidArgumentException('Listen port must be greater than zero');
        }

        return new self($listenHost, $listenPort, $callbackUrl, $certificateFilePath);
    }

    /**
     * @param string $sslCertificateFilePath
     *
     * @throws \InvalidArgumentException
     *
     * @return void
     */
    private static function validateSslCertificateFilePath(string $sslCertificateFilePath): void
    {
        if (false === \file_exists($sslCertificateFilePath))
        {
            throw new \InvalidArgumentException(
                \sprintf('The specified certificate file ("%s") was not found', $sslCertificateFilePath)
            );
        }

        if (false === \is_readable($sslCertificateFilePath))
        {
            throw new \InvalidArgumentException(
                \sprintf('The specified certificate file ("%s") is not readable', $sslCertificateFilePath)
            );
        }
    }

    /**
     * @param string $callbackUrl
     *
     * @throws \InvalidArgumentException
     *
     * @return void
     *
     */
    private static function validateCallbackUrl(string $callbackUrl): void
    {
        if ('' === $callbackUrl)
        {
            throw new \InvalidArgumentException('Incorrect callback URL: can\'t be empty');
        }

        $parts = \parse_url($callbackUrl);

        if (false === \is_array($parts))
        {
            throw new \InvalidArgumentException('Invalid callback URL specified');
        }

        if (false === isset($parts['scheme']) || 'https' !== $parts['scheme'])
        {
            throw new \InvalidArgumentException('Incorrect callback URL: the scheme can only be "https"');
        }

        if (true === isset($parts['port']) && false === \in_array($parts['port'], self::SUPPORTED_NOTIFICATION_URL_PORTS, true))
        {
            throw new \InvalidArgumentException(
                \sprintf(
                    'Incorrect callback URL: incorrect port specified ("%d"). Available choices: %s',
                    (int) $parts['port'],
                    \implode(', ', self::SUPPORTED_NOTIFICATION_URL_PORTS)
                )
            );
        }
    }

    /**
     * @param string      $listenHost
     * @param int         $listenPort
     * @param string      $notificationsUrl
     * @param string|null $certificateFilePath
     */
    private function __construct(
        string $listenHost,
        int $listenPort,
        string $notificationsUrl,
        ?string $certificateFilePath
    ) {
        $this->listenHost          = $listenHost;
        $this->listenPort          = $listenPort;
        $this->callbackUrl         = $notificationsUrl;
        $this->certificateFilePath = $certificateFilePath;
    }
}
