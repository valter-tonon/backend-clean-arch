<?php

namespace Core\UseCase\DTO\Category;

class ListCategoriesOutputDTO
{

    public function __construct(
        public int $page,
        public int $perPage,
        public int $total,
        public int $lastPage,
        public int $firstPage,
        public int $from,
        public int $to,
        public array $items = []
    ){
    }

}