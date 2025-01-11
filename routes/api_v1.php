<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\BookingController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\FashionModelController;
use App\Http\Controllers\Api\V1\FashionModelImageController;

Route::controller(AuthController::class)
    ->prefix('auth')
    ->name('auth.')
    ->group(function () {
        Route::get('/', 'show')->name('show')->middleware('auth:sanctum');
        Route::post('/', 'store')->name('store');
        Route::delete('/', 'destroy')->name('destroy')->middleware('auth:sanctum');
    });

Route::controller(CategoryController::class)
    ->prefix("categories")
    ->name("categories.")
    ->group(function () {
        Route::get("/", "index")->name("index");
        Route::get("/{id}", "show")->name("show");
        Route::post("/", "store")->name("store")->middleware(["auth:sanctum"]);
        Route::put("/{id}", "update")->name("update")->middleware(["auth:sanctum"]);
        Route::delete("/{id}", "destroy")->name("destroy")->middleware(["auth:sanctum"]);
    });

Route::controller(BookingController::class)
    ->prefix("bookings")
    ->name("bookings.")
    ->group(function () {
        Route::get("/", "index")->name("index")->middleware(["auth:sanctum"]);
        Route::post("/", "store")->name("store")->middleware(["auth:sanctum"]);
    });

Route::controller(FashionModelController::class)
    ->prefix("fashion-models")
    ->name("fashion-models.")
    ->group(function () {
        Route::get("/", "index")->name("index");
        Route::get("/{id}", "show")->name("show");
        Route::post("/", "store")->name("store")->middleware(["auth:sanctum"]);
        Route::put("/{id}", "update")->name("update")->middleware(["auth:sanctum"]);
        Route::delete("/{id}", "destroy")->name("destroy")->middleware(["auth:sanctum"]);
    });
    
    Route::controller(FashionModelImageController::class)
    ->prefix("fashion-models")
    ->name("fashion-models.images.")
    ->group(function () {
        Route::post("{id}/images", "store")->name("store")->middleware(["auth:sanctum"]);
        Route::delete("/{id}/images", "destroy")->name("destroy")->middleware(["auth:sanctum"]);
    });
