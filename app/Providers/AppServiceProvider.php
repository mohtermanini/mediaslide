<?php

namespace App\Providers;

use App\Enums\RolesEnum;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rules\Password;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //Password default rules when calling [Password::defaults()] as in [StoreAuthRequest]
        Password::defaults(fn () => Password::min(8)->letters()->mixedCase()->numbers());
    }
}
