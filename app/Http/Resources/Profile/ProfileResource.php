<?php

namespace App\Http\Resources\Profile;

use App\Enums\GendersEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'gender' => strtolower(GendersEnum::from($this->gender)->name),
            'fullName' => $this->full_name
        ];
    }
}
