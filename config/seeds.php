<?php

use App\Enums\GendersEnum;
use App\Enums\RolesEnum;
use App\Enums\UserStatusesEnum;

return [
    'users' => [
        [
            'email' => 'mohtermanini.job@gmail.com',
            'password' => 'Password123',
            'profile' => [
                'first_name' => 'Mohamad',
                'last_name' => 'Termanini',
                'gender' => GendersEnum::MALE,
            ],
            'role_id' => RolesEnum::ADMIN,
            'status_id' => UserStatusesEnum::ACTIVE,
        ],
    ],
];
