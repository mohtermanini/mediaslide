<?php

namespace App\Repositories;

use App\Models\FashionModel;
use App\Filters\FashionModel\FashionModelFilters;
use App\Interfaces\Repositories\FashionModelRepositoryInterface;

class FashionModelRepository implements FashionModelRepositoryInterface
{
    public function getFashionModels(array $filters, ?int $pageSize = null)
    {
        $queryBuilder = FashionModel::with(['category', 'fashionModelImages'])
            ->select('*');

        $filteredQuery = app(FashionModelFilters::class)->filter([
            'queryBuilder' => $queryBuilder,
            'params' => $filters,
        ]);

        return $filteredQuery->when($pageSize, fn($query) => $query->paginate($pageSize), fn($query) => $query->get());
    }

    public function getFashionModel(int $id): ?FashionModel
    {
        return FashionModel::with(['category', 'fashionModelImages'])->find($id);
    }

    public function create(array $data): FashionModel
    {
        return FashionModel::create([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'date_of_birth' => $data['dateOfBirth'],
            'height' => $data['height'],
            'shoe_size' => $data['shoeSize'],
            'gender' => $data['gender'],
            'category_id' => $data['categoryId'] ?? null,
        ]);
    }

    public function update(FashionModel $fashionModel, array $data): bool
    {
        return $fashionModel->update([
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'date_of_birth' => $data['dateOfBirth'],
            'height' => $data['height'],
            'shoe_size' => $data['shoeSize'],
            'gender' => $data['gender'],
            'category_id' => $data['categoryId'] ?? null,
        ]);
    }

    public function removeCategoryFromFashionModels(int $categoryId): void
    {
        FashionModel::where('category_id', $categoryId)->update(['category_id' => null]);
    }

    public function delete(FashionModel $fashionModel): bool
    {
        return $fashionModel->delete();
    }

    public function hasFutureBookings(FashionModel $fashionModel): bool
    {
        return $fashionModel->bookings()
            ->whereDate('booking_date', '>=', now()->toDateString())
            ->exists();
    }
}
