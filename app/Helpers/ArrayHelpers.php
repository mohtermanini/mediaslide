<?php

namespace App\Helpers;

use Illuminate\Support\Str;

class ArrayHelpers
{
    public static function snakeToCamelKeys(array $data): array
    {
        return collect($data)
            ->mapWithKeys(fn($value, $key) => [Str::camel($key) => $value])
            ->toArray();
    }
}
