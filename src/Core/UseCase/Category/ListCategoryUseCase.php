<?php

namespace Core\UseCase\Category;


use Core\Domain\Repository\ICategoryRepository;
use Core\UseCase\DTO\Category\CategoryInputDTO;
use Core\UseCase\DTO\Category\CategoryOutputDTO;

class ListCategoryUseCase
{
    public function __construct(
        protected ICategoryRepository $categoryRepository
    )
    {
    }


    public function execute(CategoryInputDTO $category): CategoryOutputDTO
    {
        $category = $this->categoryRepository->findById($category->id);
        return new CategoryOutputDTO(
            id: $category->id,
            name: $category->name,
            description: $category->description,
            isActive: $category->isActive
        );
    }

}