<?php

namespace Core\UseCase\Category;

use Core\Domain\Entity\Category;
use Core\Domain\Repository\ICategoryRepository;
use Core\UseCase\DTO\Category\ListCategoriesInputDTO;
use Core\UseCase\DTO\Category\ListCategoriesOutputDTO;

class ListCategoriesUseCase
{
    public function __construct(
        protected ICategoryRepository $categoryRepository
    ){}

    public function execute(ListCategoriesInputDTO $input): ListCategoriesOutputDTO
    {
        $categories = $this->categoryRepository->paginate(
            conditions: $input->conditions,
            order: $input->orderBy,
            page: $input->page,
            limit: $input->perPage
        );

        return new ListCategoriesOutputDTO(
            page: $categories->currentPage(),
            perPage: $categories->perPage(),
            total: $categories->total(),
            lastPage: $categories->lastPage(),
            firstPage: $categories->firstPage(),
            from: $categories->from(),
            to: $categories->to(),
            items: $categories->items()
        );
    }

}