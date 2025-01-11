<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Profile\ProfileResource;
use App\Http\Resources\Role\RoleResource;
use App\Http\Resources\UserStatus\UserStatusResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'email' => $this->email,
            'profile' => new ProfileResource($this->whenLoaded('profile')),
            'role' => new RoleResource($this->whenLoaded('role')),
            'status' => new UserStatusResource($this->whenLoaded('status')),
        ];
    }
}
