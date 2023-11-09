<?php

namespace Core\UseCase\Category;

use Core\Domain\Repository\ICategoryRepository;
use Core\UseCase\DTO\Category\CategoryDeleteOutputDTO;
use Core\UseCase\DTO\Category\CategoryInputDTO;

class CategoryDeleteUseCase
{
    public function __construct(
        protected ICategoryRepository $categoryRepository
    )
    {
    }

    public function execute(CategoryInputDTO $category): CategoryDeleteOutputDTO
    {
        $response = $this->categoryRepository->delete($category->id);
        return new CategoryDeleteOutputDTO(
            success: $response
        );

    }

}