<?php

namespace App\Repositories;

use App\Models\Booking;
use App\Filters\Booking\BookingFilters;
use App\Interfaces\Repositories\BookingRepositoryInterface;

class BookingRepository implements BookingRepositoryInterface
{
    public function getBookings(array $filters, ?int $pageSize = null)
    {
        $queryBuilder = Booking::with(['fashionModel'])->select('*');

        $filteredQuery = app(BookingFilters::class)->filter([
            'queryBuilder' => $queryBuilder,
            'params' => $filters,
        ]);

        return $filteredQuery->when(
            $pageSize,
            fn($query) => $query->paginate($pageSize),
            fn($query) => $query->get()
        );
    }

    public function getBooking(int $id): ?Booking
    {
        return Booking::with('fashionModel')->find($id);
    }

    public function create(array $data): Booking
    {
        return Booking::create([
            'customer_name' => $data['customerName'],
            'fashion_model_id' => $data['modelId'],
            'booking_date' => $data['bookingDate'],
        ]);
    }

    public function deleteBookingsByFashionModelId(int $fashionModelId): void
    {
        Booking::where('fashion_model_id', $fashionModelId)->delete();
    }

    public function hasDuplicateBooking(string $customerName, int $modelId, string $bookingDate): bool
    {
        return Booking::where('customer_name', $customerName)
            ->where('fashion_model_id', $modelId)
            ->whereDate('booking_date', $bookingDate)
            ->exists();
    }
}
