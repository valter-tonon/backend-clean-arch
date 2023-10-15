<?php

namespace Core\UseCase\Category;

use Core\Domain\Entity\Category;
use Core\Domain\Repository\ICategoryRepository;
use Core\UseCase\DTO\Category\CategoryCreateInputDTO;
use Core\UseCase\DTO\Category\CategoryCreateOutputDTO;

class CreateCategoryUseCase
{
    public function __construct(
        protected ICategoryRepository $categoryRepository
    )
    {
    }

    public function execute(CategoryCreateInputDTO $category): CategoryCreateOutputDTO
    {
        $category = new Category(
            name: $category->name,
            description: $category->description,
            isActive: $category->isActive
        );
        $categoryInserted = $this->categoryRepository->insert($category);
        return new CategoryCreateOutputDTO(
            id: $categoryInserted->id,
            name: $categoryInserted->name,
            description: $categoryInserted->description,
            isActive: $categoryInserted->isActive
        );
    }

}