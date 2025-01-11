<?php

namespace App\Filters\Booking;

use App\Filters\BaseFilters;

class BookingFilters extends BaseFilters
{
    public function __construct(public $filters = null)
    {
        $this->filters = $filters ?? [
            CustomerName::class,
            FashionModelId::class,
            BookingDate::class,
        ];
    }

    protected function getFilters(): array
    {
        return $this->filters;
    }
}