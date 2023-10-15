<?php

namespace Core\UseCase\DTO\Category;

use Core\Domain\ValueObject\Uuid;

class CategoryInputDTO
{
    public function __construct(
        public string $id
    )
    {
    }

}