<?php

namespace App\Services;

use App\Interfaces\Repositories\BookingRepositoryInterface;
use App\Models\Booking;
use Illuminate\Support\Facades\Gate;

class BookingService
{
    protected $bookingRepository;

    public function __construct(BookingRepositoryInterface $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

    public function getBookings($filters, $pageSize = null)
    {
        return $this->bookingRepository->getBookings($filters, $pageSize);
    }

    public function createFromRequest($request)
    {
        if (Gate::denies('create', Booking::class)) {
            throw new \Exception('Not Authorized.', 403);
        }

        if ($this->bookingRepository->hasDuplicateBooking(
            $request->customerName,
            $request->modelId,
            $request->bookingDate
        )) {
            throw new \Exception('A booking already exists for this customer, model and date.', 422);
        }

        $data = $request->only([
            'customerName',
            'modelId',
            'bookingDate',
        ]);

        $booking = $this->bookingRepository->create($data);

        return $this->bookingRepository->getBooking($booking->id);
    }
}
