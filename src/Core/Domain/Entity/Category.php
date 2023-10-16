<?php

namespace Core\Domain\Entity;

use Core\Domain\Entity\Traits\MagicMethodsTrait;
use Core\Domain\Exception\EntityValidationException;
use Core\Domain\Validation\DomainValidation;
use Core\Domain\ValueObject\Uuid;

class Category
{
    use MagicMethodsTrait;
public function __construct(
        protected Uuid|string $id = '',
        protected string     $name = '',
        protected string     $description = '',
        protected bool       $isActive = true,
        protected ?\DateTime $createdAt = null,
        protected ?\DateTime $updatedAt = null
    ) {
        $this->id = $this->id ? new Uuid($this->id): Uuid::random();
        $this->createdAt = $this->createdAt ?: new \DateTime();
        $this->updatedAt = $updatedAt ?? new \DateTime();
        $this->validate();
    }

    public function activate(): void
    {
        $this->isActive = true;
    }

    public function disable()
    {
        $this->isActive = false;
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public function update(string $name, ?string $description): void
    {
        $this->name = $name;
        $this->description = $description ?: $this->description;
        $this->updatedAt = new \DateTime();
        $this->validate();
    }

    protected function validate(): void
    {
        DomainValidation::notNull($this->name, 'Name is required');
        DomainValidation::minLength($this->name, 3, 'Name must be at least 3 characters');
        DomainValidation::maxLength($this->name, 255, 'Name must be at most 255 characters');
        DomainValidation::strCanNullAndAndMaxLenght($this->description, 255, 'Description must be at most 255 characters');
        DomainValidation::strCanNullAndAndMinLenght($this->description, 3, 'Description must be at least 3 characters');
    }
}