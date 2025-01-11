<?php

namespace App\Http\Resources\Booking;

use App\Http\Resources\FashionModel\FashionModelResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'customerName' => $this->customer_name,
            'model' =>   new FashionModelResource($this->whenLoaded('fashionModel')),
            'bookingDate' => $this->booking_date
        ];
    }
}
