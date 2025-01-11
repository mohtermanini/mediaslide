<?php

namespace App\Policies;

use App\Enums\RolesEnum;
use App\Models\FashionModel;
use App\Models\User;

class FashionModelPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, FashionModel $fashionModel): bool
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

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, FashionModel $fashionModel): bool
    {
        return $user->role_id === RolesEnum::ADMIN->value;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, FashionModel $fashionModel): bool
    {
        return $user->role_id === RolesEnum::ADMIN->value;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, FashionModel $fashionModel): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, FashionModel $fashionModel): bool
    {
        //
    }
}
