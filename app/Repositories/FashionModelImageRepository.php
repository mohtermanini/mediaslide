<?php

namespace App\Repositories;

use App\Interfaces\Repositories\FashionModelImageRepositoryInterface;
use App\Models\FashionModelImage;

class FashionModelImageRepository implements FashionModelImageRepositoryInterface
{
    public function insert(array $imagesData): void
    {
        FashionModelImage::insert($imagesData);
    }

    public function deleteByIds(array $imageIds): void
    {
        FashionModelImage::whereIn('id', $imageIds)->delete();
    }

    public function deleteImagesByFashionModelId(int $fashionModelId): void
    {
        FashionModelImage::where('fashion_model_id', $fashionModelId)->delete();
    }
}
