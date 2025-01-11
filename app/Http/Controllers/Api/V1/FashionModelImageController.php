<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\FashionModelImage\StoreFashionModelImageRequest;
use App\Http\Resources\FashionModel\FashionModelResource;
use App\Services\FashionModelImageService;

class FashionModelImageController extends Controller
{
    public function store(StoreFashionModelImageRequest $storeFashionModelImageRequest, FashionModelImageService $fashionModelImageService)
    {
        try {
            $fashionModel = $fashionModelImageService->createFromRequest(request()->id, $storeFashionModelImageRequest);
        } catch (\Exception $e) {
            abort($e->getCode(), $e->getMessage());
        }

        return $this->responseCreated(new FashionModelResource($fashionModel));
    }

    public function destroy(FashionModelImageService $fashionModelImageService, $id)
    {
        try {
            $fashionModelImageService->delete($id, request()->imageIds);
        } catch (\Exception $e) {
            abort($e->getCode(), $e->getMessage());
        }

        return $this->responseDeleted();
    }
}
