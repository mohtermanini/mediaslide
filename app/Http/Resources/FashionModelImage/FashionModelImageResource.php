<?php

namespace App\Http\Resources\FashionModelImage;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FashionModelImageResource extends JsonResource
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
            'url' => $this->url,
            'altText' => $this->alt_text,
        ];
    }
}
