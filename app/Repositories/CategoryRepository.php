<?php

namespace App\Repositories;

use App\Interfaces\Repositories\CategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getCategories(): object
    {
        return Category::whereNull('category_id')->with('childrenCategories')->get();
    }

    public function getCategory(int $id): ?Category
    {
        return Category::with('childrenCategories', 'parentCategory')->find($id);
    }

    public function create(array $data): Category
    {
        return Category::create([
            'name' =>  $data['name'],
            'category_id' =>  $data['categoryId'] ?? null,
        ]);
    }

    public function update(Category $category, array $data): bool
    {
        return $category->update([
            'name' =>  $data['name'],
            'category_id' =>  $data['categoryId'] ?? null,
        ]);
    }

    public function delete(Category $category): bool
    {
        return $category->delete();
    }

    public function hasSubcategories(int $categoryId): bool
    {
        return Category::where('category_id', $categoryId)->exists();
    }

    public function getSubCategoryIds(int $categoryId): array
    {
        $query = <<<SQL
            WITH RECURSIVE category_tree AS (
                SELECT id, category_id
                FROM categories
                WHERE id = :root_category_id
                UNION ALL
                SELECT c.id, c.category_id
                FROM categories c
                INNER JOIN category_tree ct ON c.category_id = ct.id
            )
            SELECT id FROM category_tree WHERE id != :excluded_category_id;
        SQL;

        return collect(DB::select($query, [
            'root_category_id' => $categoryId,
            'excluded_category_id' => $categoryId,
        ]))->pluck('id')->toArray();
    }
}
