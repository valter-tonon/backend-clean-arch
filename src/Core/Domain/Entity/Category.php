<?php

namespace Core\Domain\Entity;

use Core\Domain\Entity\Traits\MagicMethodsTrait;
use Core\Domain\Exception\EntityValidationException;

class Category
{
    use MagicMethodsTrait;
public function __construct(
        protected ?string       $id = '',
        protected string     $name = '',
        protected string     $description = '',
        protected bool       $isActive = true,
        protected ?\DateTime $created_at = null,
        protected ?\DateTime $updated_at = null
    ) {
        $this->created_at = $created_at ?? new \DateTime();
        $this->updated_at = $updated_at ?? new \DateTime();
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

    public function update(string $name, string $description=''): void
    {
        $this->name = $name;
        $this->description = $description ?: $this->description;
        $this->updated_at = new \DateTime();
        $this->validate();
    }

    protected function validate(): void
    {
        if (empty($this->name)) {
            throw new EntityValidationException('Name is required');
        }
        if (strlen($this->name) < 3) {
            throw new EntityValidationException('Name must be at least 3 characters');
        }
        if (!empty($this->description) && (strlen($this->description) > 255 || strlen($this->description) < 3)) {
            throw new EntityValidationException('Description must be at least 3 characters and at most 255 characters');
        }

    }
}