<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::controller(AuthController::class)->group(function () {
    Route::post('/register', 'register')->name('register');
    Route::post('/login', 'login')->name('login');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', 'logout')->name('logout');
    });
});


Route::apiResource('categories', CategoryController::class)->only('index', 'show');
Route::middleware('auth:sanctum', 'is-admin')->group(function () {
    Route::apiResource('categories', CategoryController::class)->only('store', 'destroy');
    Route::post('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::patch('/categories/{category}/toggle', [CategoryController::class, 'toggle'])->name('categories.toggle');
});

Route::apiResource('events', EventController::class)->only('index', 'show');
Route::middleware('auth:sanctum', 'is-admin')->group(function () {
    Route::apiResource('events', EventController::class)->only('store', 'destroy');
    Route::post('/events/{event}', [EventController::class, 'update'])->name('events.update');
    Route::patch('/events/{event}/toggle', [EventController::class, 'toggle'])->name('events.toggle');
});

Route::middleware('auth:sanctum', 'is-admin')->group(function () {
    Route::apiResource('bookings', BookingController::class)->only('index', 'show');
    Route::post('/bookings', [BookingController::class, 'store'])->name('bookings.store');
    Route::put('/bookings/{booking}', [BookingController::class, 'update'])->name('bookings.update');
    Route::patch('/bookings/{booking}/toggle', [BookingController::class, 'toggle'])->name('bookings.toggle');
});
