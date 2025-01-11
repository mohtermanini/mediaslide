<?php

namespace App\Policies;

use App\Enums\RolesEnum;
use App\Models\User;

class BookingPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->role_id === RolesEnum::ADMIN->value;
    }
}
