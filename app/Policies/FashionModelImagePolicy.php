<?php

namespace App\Policies;

use App\Enums\RolesEnum;
use App\Models\FashionModelImage;
use App\Models\User;

class FashionModelImagePolicy
{

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role_id === RolesEnum::ADMIN->value;
    }


    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, FashionModelImage $fashionModelImage): bool
    {
        return $user->role_id === RolesEnum::ADMIN->value;
    }
}
