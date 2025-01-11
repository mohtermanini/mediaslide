<?php

namespace App\Interfaces\Repositories;

use App\Models\Category;

interface CategoryRepositoryInterface
{
    public function getCategories(): object;

    public function getCategory(int $id): ?Category;

    public function create(array $data): Category;

    public function update(Category $category, array $data): bool;

    public function delete(Category $category): bool;

    public function hasSubcategories(int $categoryId): bool;

    public function getSubCategoryIds(int $categoryId): array;
}
