<?php

/**
 * Telegram Bot API.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\TelegramBot\Interaction\Result;

use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * Operation failed.
 */
final class Fail implements Result
{
    /**
     * Error caused by invalid request parameters?
     *
     * @var bool
     */
    public $isValidationFailed;

    /**
     * If the error occurred due to request parameters, contains a list of violations.
     *
     * @var array
     */
    public $violations;

    /**
     * Error description.
     *
     * @var string
     */
    public $errorMessage;

    /**
     * @param ConstraintViolationListInterface $violationList
     *
     * @return self
     */
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

    /**
     * @param string $reason
     *
     * @return self
     */
    public static function error(string $reason): self
    {
        return new self(false, [], $reason);
    }

    /**
     * @param bool   $isValidationFailed
     * @param array  $violations
     * @param string $errorMessage
     */
    private function __construct(bool $isValidationFailed, array $violations, string $errorMessage)
    {
        $this->isValidationFailed = $isValidationFailed;
        $this->violations         = $violations;
        $this->errorMessage       = $errorMessage;
    }
}
