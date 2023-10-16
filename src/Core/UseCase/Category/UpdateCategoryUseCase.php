<?php

namespace Core\UseCase\Category;

use Core\Domain\Repository\ICategoryRepository;
use Core\UseCase\DTO\Category\UpdateCategoryInputDTO;
use Core\UseCase\DTO\Category\UpdateCategoryOutputDTO;

class UpdateCategoryUseCase
{
    public function __construct(
        protected ICategoryRepository $categoryRepository
    ){}

    public function execute(UpdateCategoryInputDTO $input): UpdateCategoryOutputDTO
    {
        $category = $this->categoryRepository->findById($input->id);
        $category->update(
            name: $input->name,
            description: $input->description
        );
        $this->categoryRepository->update($category);
        return new UpdateCategoryOutputDTO(
            id: $category->id,
            name: $category->name,
            description: $category->description,
            isActive: $category->isActive
        );
    }



}