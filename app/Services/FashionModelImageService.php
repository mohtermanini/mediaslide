<?php

namespace App\Services;

use App\Interfaces\Repositories\FashionModelImageRepositoryInterface;
use App\Interfaces\Repositories\FashionModelRepositoryInterface;
use App\Models\FashionModelImage;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;

class FashionModelImageService
{
    protected $fashionModelImageRepository;
    protected $fashionModelRepository;

    public function __construct(
        FashionModelImageRepositoryInterface $fashionModelImageRepository,
        FashionModelRepositoryInterface $fashionModelRepository
    ) {
        $this->fashionModelImageRepository = $fashionModelImageRepository;
        $this->fashionModelRepository = $fashionModelRepository;
    }

    public function createFromRequest($fashionModelId, $request)
    {
        if (Gate::denies('create', FashionModelImage::class)) {
            throw new \Exception('Not Authorized.', 403);
        }

        $fashionModel = $this->fashionModelRepository->getFashionModel($fashionModelId);
        if (!$fashionModel) {
            throw new \Exception('FashionModel not found.', 422);
        }


        $imagesData = [];
        foreach ($request->file('images') as $key => $image) {
            $path = $image->store(Config::get('entity_configurations.fashion_models.storage_path'), 'public');

            $imagesData[] = [
                'fashion_model_id' => $fashionModel->id,
                'url' => $path,
                'alt_text' => $request->altText ?? $fashionModel->name,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        $this->fashionModelImageRepository->insert($imagesData);

        return $this->fashionModelRepository->getFashionModel($fashionModelId);
    }


    public function delete($fashionModelId,  $imageIds)
    {
        $fashionModel = $this->fashionModelRepository->getFashionModel($fashionModelId);

        if (!$fashionModel) {
            throw new \Exception('FashionModel not found.', 422);
        }

        if (Gate::inspect('delete', [$fashionModel])->denied()) {
            throw new \Exception('Not Authorized.', 403);
        }

        $this->fashionModelImageRepository->deleteByIds($imageIds);
    }
}
