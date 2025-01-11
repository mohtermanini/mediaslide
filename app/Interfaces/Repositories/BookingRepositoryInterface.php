<?php

namespace App\Interfaces\Repositories;

use App\Models\Booking;

interface BookingRepositoryInterface
{
    public function getBookings(array $filters, ?int $pageSize = null);

    public function getBooking(int $id): ?Booking;

    public function create(array $data): Booking;

    public function deleteBookingsByFashionModelId(int $fashionModelId): void;

    public function hasDuplicateBooking(string $customerName, int $modelId, string $bookingDate): bool;
}
