<?php

namespace App\Services;

use App\Enums\UserStatusesEnum;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getUserByCredentialsOrFail($email, $password)
    {
        $user = $this->userService->getUserByEmail($email);

        if (!$user || !Hash::check($password, $user->password)) {
            throw new \Exception("Invalid credentials", 422);
        }

        if ($user->status_id === UserStatusesEnum::BLOCKED->value) {
            throw new \Exception("User account is blocked.", 422);
        }

        return $user;
    }
}
