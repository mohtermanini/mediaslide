<?php

namespace App\Services;

use App\Interfaces\Repositories\CategoryRepositoryInterface;
use App\Interfaces\Repositories\FashionModelRepositoryInterface;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class CategoryService
{
    protected $categoryRepository;
    protected $fashionModelRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository, FashionModelRepositoryInterface $fashionModelRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->fashionModelRepository = $fashionModelRepository;
    }
    public function getCategories()
    {
        return $this->categoryRepository->getCategories();
    }

    public function getCategory($id)
    {
        $category = $this->categoryRepository->getCategory($id);

        if (!$category) {
            throw new \Exception('Category Not Found.', 404);
        }

        return $category;
    }

    public function createFromRequest($request)
    {
        if (Gate::denies('create', Category::class)) {
            throw new \Exception('Not Authorized.', 403);
        }

        $data = $request->only([
            'name',
            'categoryId',
        ]);

        $category = $this->categoryRepository->create($data);

        return $this->categoryRepository->getCategory($category->id);
    }

    public function updateFromRequest($request, $id)
    {
        $category = $this->categoryRepository->getCategory($id);

        if (!$category) {
            throw new \Exception('Category not found.', 422);
        }

        if (Gate::inspect('update', [$category])->denied()) {
            throw new \Exception('Not Authorized.', 403);
        }

        if ($request->categoryId == $category->id) {
            throw new \Exception("Category can't be assigned to itself.", 422);
        }

        $subCategoryIds = $this->categoryRepository->getSubCategoryIds($category->id);
        if (in_array($request->categoryId, $subCategoryIds)) {
            throw new \Exception("Category can't be assigned to one of its subcategories.", 422);
        }

        $data = $request->only([
            'name',
            'categoryId',
        ]);

        $this->categoryRepository->update($category, $data);

        return $this->categoryRepository->getCategory($category->id);
    }

    public function delete($id)
    {
        $category = $this->categoryRepository->getCategory($id);

        if (!$category) {
            throw new \Exception('Category not found.', 422);
        }

        if (Gate::inspect('delete', [$category])->denied()) {
            throw new \Exception('Not Authorized.', 403);
        }

        if ($this->categoryRepository->hasSubcategories($category->id)) {
            throw new \Exception("Category cannot be deleted because it has associated subcategories.", 422);
        }

        DB::transaction(function () use ($category) {
            $this->fashionModelRepository->removeCategoryFromFashionModels($category->id);
            $this->categoryRepository->delete($category);
        });
    }
}
