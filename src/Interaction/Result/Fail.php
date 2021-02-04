<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <contacts@desperado.dev>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Interaction\Result;

use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * Operation failed.
 *
 * @psalm-immutable
 */
final class Fail implements Result
{
    /**
     * Error caused by invalid request parameters?
     *
     * @psalm-readonly
     *
     * @var bool
     */
    public $isValidationFailed;

    /**
     * If the error occurred due to request parameters, contains a list of violations.
     *
     * @psalm-readonly
     *
     * @var array
     */
    public $violations;

    /**
     * Error description.
     *
     * @psalm-readonly
     *
     * @var string
     */
    public $errorMessage;

    public static function validationFailed(ConstraintViolationListInterface $violationList): self
    {
        $violations = [];

        /** @var \Symfony\Component\Validator\ConstraintViolation $violation */
        foreach ($violationList as $violation)
        {
            $violations[$violation->getPropertyPath()][] = $violation->getMessage();
        }

        return new self(true, $violations, 'Validation failed');
    }

    public static function error(string $reason): self
    {
        return new self(false, [], $reason);
    }

    private function __construct(bool $isValidationFailed, array $violations, string $errorMessage)
    {
        $this->isValidationFailed = $isValidationFailed;
        $this->violations         = $violations;
        $this->errorMessage       = $errorMessage;
    }
}
