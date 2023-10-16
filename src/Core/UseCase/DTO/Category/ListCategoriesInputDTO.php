<?php

namespace Core\UseCase\DTO\Category;

class ListCategoriesInputDTO
{

    public function __construct(
        public string $orderBy = 'DESC',
        public string $conditions = '',
        public int $page = 1,
        public int $perPage = 10
    ){
    }

}