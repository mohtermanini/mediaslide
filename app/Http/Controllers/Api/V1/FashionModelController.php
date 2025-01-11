<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\FashionModel\StoreFashionModelRequest;
use App\Http\Requests\FashionModel\UpdateFashionModelRequest;
use App\Http\Resources\FashionModel\FashionModelCollection;
use App\Http\Resources\FashionModel\FashionModelResource;
use App\Services\FashionModelService;

class FashionModelController extends Controller
{
    public function index(FashionModelService $fashionModelService)
    {
        $fashionModels = $fashionModelService->getFashionModels(
            filters: request()->all(),
            pageSize: request()->pageSize ?? config('meta.pagination.page_size')
        );

        return new FashionModelCollection($fashionModels);
    }

    public function show(FashionModelService $fashionModelService, $id)
    {
        try {
            $fashionModel = $fashionModelService->getFashionModel($id);
        } catch (\Exception $e) {
            abort($e->getCode(), $e->getMessage());
        }

        return new FashionModelResource($fashionModel);
    }

    public function store(StoreFashionModelRequest $storeFashionModelRequest, FashionModelService $fashionModelService)
    {
        try {
            $fashionModel = $fashionModelService->createFromRequest($storeFashionModelRequest);
        } catch (\Exception $e) {
            abort($e->getCode(), $e->getMessage());
        }

        return $this->responseCreated(new FashionModelResource($fashionModel));
    }

    public function update(UpdateFashionModelRequest $updateFashionModelRequest, FashionModelService $fashionModelService, $id)
    {
        try {
            $fashionModel = $fashionModelService->updateFromRequest($updateFashionModelRequest, $id);
        } catch (\Exception $e) {
            abort($e->getCode(), $e->getMessage());
        }

        return $this->responseOk(new FashionModelResource($fashionModel));
    }

    public function destroy(FashionModelService $fashionModelService, $id)
    {
        try {
            $fashionModelService->delete($id);
        } catch (\Exception $e) {
            abort($e->getCode(), $e->getMessage());
        }

        return $this->responseDeleted();
    }
}
