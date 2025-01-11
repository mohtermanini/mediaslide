<?php

namespace App\Services;

use App\Interfaces\Repositories\BookingRepositoryInterface;
use App\Interfaces\Repositories\FashionModelImageRepositoryInterface;
use App\Interfaces\Repositories\FashionModelRepositoryInterface;
use App\Models\FashionModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class FashionModelService
{
    protected $fashionModelRepository;
    protected $bookingRepository;
    protected $fashionModelImageRepository;

    public function __construct(
        FashionModelRepositoryInterface $fashionModelRepository,
        BookingRepositoryInterface $bookingRepository,
        FashionModelImageRepositoryInterface $fashionModelImageRepository
    ) {
        $this->fashionModelRepository = $fashionModelRepository;
        $this->bookingRepository = $bookingRepository;
        $this->fashionModelImageRepository = $fashionModelImageRepository;
    }

    public function getFashionModels($filters, $pageSize = null)
    {
        return $this->fashionModelRepository->getFashionModels($filters, $pageSize);
    }

    public function getFashionModel($id)
    {
        $fashionModel = $this->fashionModelRepository->getFashionModel($id);
        if (!$fashionModel) {
            throw new \Exception('Model Not Found.', 404);
        }

        return $fashionModel;
    }

    public function createFromRequest($request)
    {
        if (Gate::denies('create', FashionModel::class)) {
            throw new \Exception('Not Authorized.', 403);
        }

        $data = $request->only([
            'name',
            'description',
            'dateOfBirth',
            'height',
            'shoeSize',
            'gender',
            'categoryId',
        ]);

        $fashionModel = $this->fashionModelRepository->create($data);

        return $this->fashionModelRepository->getFashionModel($fashionModel->id);
    }

    public function updateFromRequest($request, $id)
    {
        $fashionModel = $this->fashionModelRepository->getFashionModel($id);

        if (!$fashionModel) {
            throw new \Exception('FashionModel not found.', 422);
        }

        if (Gate::inspect('update', [$fashionModel])->denied()) {
            throw new \Exception('Not Authorized.', 403);
        }

        $data = $request->only([
            'name',
            'description',
            'dateOfBirth',
            'height',
            'shoeSize',
            'gender',
            'categoryId',
        ]);

        $this->fashionModelRepository->update($fashionModel, $data);

        return $this->fashionModelRepository->getFashionModel($id);
    }

    public function delete($id)
    {
        $fashionModel = $this->fashionModelRepository->getFashionModel($id);

        if (!$fashionModel) {
            throw new \Exception('FashionModel not found.', 422);
        }

        if (Gate::inspect('delete', [$fashionModel])->denied()) {
            throw new \Exception('Not Authorized.', 403);
        }

        if ($this->fashionModelRepository->hasFutureBookings($fashionModel)) {
            throw new \Exception("Can't delete model with future bookings.", 422);
        }

        DB::transaction(function () use ($fashionModel) {
            $this->bookingRepository->deleteBookingsByFashionModelId($fashionModel->id);
            $this->fashionModelImageRepository->deleteImagesByFashionModelId($fashionModel->id);
            $this->fashionModelRepository->delete($fashionModel);
        });
    }
}
