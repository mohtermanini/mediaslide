<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\BookController;

Route::controller(BookController::class)
    ->prefix("books")
    ->name("books.")
    ->middleware(["auth:sanctum"])
    ->group(function () {
        Route::get("/", "index")->name("index");
    });
