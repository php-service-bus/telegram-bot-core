<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\EntryPoint\Configuration;

/**
 * Webhooks configuration.
 */
final class WebHooksConfig implements EntryPointConfig
{
    private const SUPPORTED_NOTIFICATION_URL_PORTS = [443, 80, 88, 8443];

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
     * Callback URL.
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
     * @throws \InvalidArgumentException Incorrect callback URL url
     * @throws \InvalidArgumentException Incorrect listening host
     * @throws \InvalidArgumentException Incorrect listening port
     * @throws \InvalidArgumentException Incorrect certificate file
     */
    public function __construct(string $listenHost, int $listenPort, string $callbackUrl, ?string $certificateFilePath = null)
    {
        self::validateCallbackUrl($callbackUrl);

        if($certificateFilePath !== null)
        {
            self::validateSslCertificateFilePath($certificateFilePath);
        }

        if($listenHost === '')
        {
            throw new \InvalidArgumentException('Listen host can\'t be empty');
        }

        if($listenPort <= 0)
        {
            throw new \InvalidArgumentException('Listen port must be greater than zero');
        }

        $this->listenHost          = $listenHost;
        $this->listenPort          = $listenPort;
        $this->callbackUrl         = \rtrim($callbackUrl, '/');
        $this->certificateFilePath = $certificateFilePath;
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
        if('' === $callbackUrl)
        {
            throw new \InvalidArgumentException('Callback URL must be specifier');
        }

        $parts = \parse_url($callbackUrl);

        if(false === \is_array($parts))
        {
            throw new \InvalidArgumentException('Can\'at parse callback URL address');
        }

        if(false === isset($parts['scheme']) || 'https' !== $parts['scheme'])
        {
            throw new \InvalidArgumentException('Callback URL scheme can only be "https"');
        }

        if(true === isset($parts['port']) && false === \in_array($parts['port'], self::SUPPORTED_NOTIFICATION_URL_PORTS, true))
        {
            throw new \InvalidArgumentException(
                \sprintf(
                    'Incorrect callback URL port specified ("%d"). Available choices: %s',
                    (int) $parts['port'],
                    \implode(', ', self::SUPPORTED_NOTIFICATION_URL_PORTS)
                )
            );
        }
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
        if(false === \file_exists($sslCertificateFilePath))
        {
            throw new \InvalidArgumentException(
                \sprintf('The specified certificate file ("%s") was not found', $sslCertificateFilePath)
            );
        }

        if(false === \is_readable($sslCertificateFilePath))
        {
            throw new \InvalidArgumentException(
                \sprintf('The specified certificate file ("%s") is not readable', $sslCertificateFilePath)
            );
        }
    }
}
