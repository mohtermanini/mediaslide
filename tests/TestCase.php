<?php

namespace Tests;

use App\Enums\RolesEnum;
use App\Enums\UserStatusesEnum;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected $seed = true;

    protected function createRandomUser(RolesEnum $role = RolesEnum::ADMIN, UserStatusesEnum $status = UserStatusesEnum::ACTIVE)
    {
        $user = User::factory()->has(Profile::factory())
            ->state(['role_id' => $role->value])
            ->state(['status_id' => $status->value])
            ->create();

        return $user;
    }
}
