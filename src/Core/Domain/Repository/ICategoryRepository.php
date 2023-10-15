<?php

namespace Core\Domain\Repository;

use Core\Domain\Entity\Category;

interface ICategoryRepository
{
    public function insert(Category $category);
    public function findById(string $id);
    public function update(Category $category): Category;
    public function delete(Category $category): bool;
    public function findAll($conditions, $order="DESC"): array;
    public function paginate($conditions, $order="DESC", $page=1, $limit=15): array;
    public function toCategory(string $id): Category;

}