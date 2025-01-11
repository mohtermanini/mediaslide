<?php

namespace App\Providers;

use App\Interfaces\Repositories\BookingRepositoryInterface;
use App\Interfaces\Repositories\CategoryRepositoryInterface;
use App\Interfaces\Repositories\FashionModelImageRepositoryInterface;
use App\Interfaces\Repositories\FashionModelRepositoryInterface;
use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Repositories\BookingRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\FashionModelImageRepository;
use App\Repositories\FashionModelRepository;
use App\Repositories\UserRepository;
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
        Password::defaults(fn() => Password::min(8)->letters()->mixedCase()->numbers());

        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(FashionModelRepositoryInterface::class, FashionModelRepository::class);
        $this->app->bind(FashionModelImageRepositoryInterface::class, FashionModelImageRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(BookingRepositoryInterface::class, BookingRepository::class);
    }
}
