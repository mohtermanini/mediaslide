<?php

namespace App\Enums;

enum UserStatusesEnum: int
{
    case ACTIVE = 1;
    case INACTIVE = 2;
    case BLOCKED = 3;
}
