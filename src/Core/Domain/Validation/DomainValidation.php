<?php

namespace Core\Domain\Validation;

use Core\Domain\Exception\EntityValidationException;

class DomainValidation
{
    public static function notNull(mixed $value, string $message = null): void
    {
        if (empty($value)) {
            throw new EntityValidationException($message ?? 'Value is required');
        }
    }

    public static function minLength(string $value, int $minLength, string $message = null): void
    {
        if (strlen($value) <= $minLength) {
            throw new EntityValidationException($message ?? "Value must be at least {$minLength} characters");
        }
    }

    public static function maxLength(string $value, int $maxLength, string $message = null): void
    {
        if (strlen($value) >= $maxLength) {
            throw new EntityValidationException($message ?? "Value must be at most {$maxLength} characters");
        }
    }

    public static function strCanNullAndAndMaxLenght(?string $value, ?int $maxLength = 255, ?string $message = null): void
    {
        if (!empty($value) && strlen($value) >= $maxLength) {
            throw new EntityValidationException($message ?? "Value must be at most {$maxLength} characters");
        }
    }

    public static function strCanNullAndAndMinLenght(?string $value, ?int $minLength = 3, ?string $message = null): void
    {
        if (!empty($value) && strlen($value) <= $minLength) {
            throw new EntityValidationException($message ?? "Value must be at least {$minLength} characters");
        }
    }

}