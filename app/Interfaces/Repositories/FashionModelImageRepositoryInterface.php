<?php

namespace App\Interfaces\Repositories;

interface FashionModelImageRepositoryInterface
{
    public function insert(array $imagesData): void;

    public function deleteByIds(array $imageIds): void;

    public function deleteImagesByFashionModelId(int $fashionModelId): void;
}
