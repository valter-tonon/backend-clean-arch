<?php

namespace Core\UseCase\DTO\Category;

class UpdateCategoryInputDTO
{
        public function __construct(
            public string $id,
            public string $name,
            public string|null $description = null,
            public bool $isActive = true
        ){
            $this->name = $name ?: $this->name;
            $this->description = $description ?: $this->description;
            $this->isActive = $isActive ?: $this->isActive;
        }

}