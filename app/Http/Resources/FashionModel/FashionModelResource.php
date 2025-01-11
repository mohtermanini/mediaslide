<?php

namespace App\Http\Resources\FashionModel;

use App\Enums\GendersEnum;
use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\FashionModelImage\FashionModelImageCollection;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FashionModelResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description,
            'dateOfBirth' => $this->date_of_birth,
            'height' => $this->height,
            'shoeSize' => $this->shoe_size,
            'gender' => strtolower(GendersEnum::from($this->gender)->name),
            'category' => new CategoryResource($this->whenLoaded('category')),
            'images' => new FashionModelImageCollection($this->whenLoaded(('fashionModelImages')))
        ];
    }
}
