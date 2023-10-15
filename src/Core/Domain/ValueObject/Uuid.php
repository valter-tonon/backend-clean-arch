<?php

namespace Core\Domain\ValueObject;


use InvalidArgumentException;
use \Ramsey\Uuid\Uuid as RamseyUuid;

class Uuid
{
    public function __construct(
        protected string $value
    )
    {
        $this->ensureIsValid();
    }

    public static function random(): Uuid
    {
        return new self(RamseyUuid::uuid4()->toString());
    }

    public function __toString(): string
    {
        return $this->value;
    }

    private function ensureIsValid(): void
    {
        if(!RamseyUuid::isValid($this->value)){
            throw new InvalidArgumentException();

        }
    }

}