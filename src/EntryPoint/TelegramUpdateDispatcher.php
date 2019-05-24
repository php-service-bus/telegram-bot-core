<?php

/**
 * Telegram TelegramBot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\EntryPoint;

use function Amp\call;
use Amp\Promise;
use Psr\Log\LoggerInterface;
use ServiceBus\TelegramBot\Api\Type\Update;

/**
 *
 */
final class TelegramUpdateDispatcher
{
    private const DEFAULT_EVENTS = [
        Event\PollChanged::class,
        Event\ChatMembersJoined::class,
        Event\ChatMemberLeft::class,
        Event\MessageReceived::class,
        Event\MessageEdited::class,
        Event\InlineQueryReceived::class,
        Event\CallbackQueryReceived::class,
        Event\ChannelPostReceived::class,
        Event\ChannelPostEdited::class,
        Event\ChosenInlineResultReceived::class,
        Event\PreCheckoutQueryReceived::class,
        Event\ShippingQueryReceived::class,
    ];

    /**
     * @psalm-var array<array-key, class-string<Event\TelegramEvent>>
     *
     * @var array
     */
    private $events;

    /**
     * @var TelegramEventBus
     */
    private $bus;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @psalm-param array<array-key, class-string<Event\TelegramEvent>> $customEvents
     *
     * @param TelegramEventBus $bus
     * @param LoggerInterface  $logger
     * @param string           ...$customEvents
     */
    public function __construct(TelegramEventBus $bus, LoggerInterface $logger, string ... $customEvents)
    {
        $this->bus    = $bus;
        $this->logger = $logger;
        /** @psalm-suppress PropertyTypeCoercion */
        $this->events = \array_merge($customEvents, self::DEFAULT_EVENTS);
    }

    /**
     * @param Update $update
     *
     * @return Promise
     */
    public function dispatch(Update $update): Promise
    {
        $event     = $this->extractEvent($update);
        $listeners = $this->bus->map($event);
        $logger    = $this->logger;

        /** @psalm-suppress InvalidArgument */
        return call(
            static function(Event\TelegramEvent $event, array $listeners) use ($logger): \Generator
            {
                if (0 === \count($listeners))
                {
                    $logger->notice('No listeners found for "{eventClass}"', ['eventClass' => \get_class($event)]);

                    return;
                }

                /** @var \ServiceBus\TelegramBot\EntryPoint\TelegramEventProcessor $listener */
                foreach ($listeners as $listener)
                {
                    try
                    {
                        yield $listener->process($event);
                    }
                    catch (\Throwable $throwable)
                    {
                        $logger->error('Error during event handling: {throwableMessage}', [
                            'throwableMessage' => $throwable->getMessage(),
                            'throwablePoint'   => \sprintf('%s:%d', $throwable->getFile(), $throwable->getLine()),
                        ]);
                    }
                }
            },
            $event,
            $listeners
        );
    }

    /**
     * @param Update $update
     *
     * @throws \LogicException
     *
     * @return Event\TelegramEvent
     *
     */
    private function extractEvent(Update $update): Event\TelegramEvent
    {
        foreach ($this->events as $eventClass)
        {
            if (true === $eventClass::supports($update))
            {
                return $eventClass::fromUpdate($update);
            }
        }

        throw new \LogicException(\sprintf('Unsupported event received (update_id: %d)', $update->updateId));
    }
}
