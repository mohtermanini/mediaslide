<?php

namespace App\Interfaces\Repositories;

use App\Models\FashionModel;

interface FashionModelRepositoryInterface
{
    public function getFashionModels(array $filters, ?int $pageSize = null);

    public function getFashionModel(int $id): ?FashionModel;

    public function create(array $data): FashionModel;

    public function update(FashionModel $fashionModel, array $data): bool;

    public function removeCategoryFromFashionModels(int $categoryId): void;

    public function delete(FashionModel $fashionModel): bool;

    public function hasFutureBookings(FashionModel $fashionModel): bool;
}
