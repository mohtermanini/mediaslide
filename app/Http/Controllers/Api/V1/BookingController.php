<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Booking\StoreBookingRequest;
use App\Http\Resources\Booking\BookingCollection;
use App\Http\Resources\Booking\BookingResource;
use App\Services\BookingService;

class BookingController extends Controller
{
    public function index(BookingService $bookingService)
    {
        $bookings = $bookingService->getBookings(
            filters: request()->all(),
            pageSize: request()->pageSize ?? config('meta.pagination.page_size')
        );

        return new BookingCollection($bookings);
    }

    public function store(StoreBookingRequest $storeBookingRequest, BookingService $bookingService)
    {
        try {
            $booking = $bookingService->createFromRequest($storeBookingRequest);
        } catch (\Exception $e) {
            abort($e->getCode(), $e->getMessage());
        }

        return $this->responseCreated(new BookingResource($booking));
    }
}
