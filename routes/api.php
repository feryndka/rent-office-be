<?php

use App\Http\Controllers\Api\BookingTransactionController;
use App\Http\Controllers\Api\CityController;
use App\Http\Controllers\Api\OfficeSpaceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('api_key')->group(function () {
    Route::get('/city/{city:slug}', [CityController::class, 'show']); // Untuk menampilkan detail data city
    Route::apiResource('/cities', CityController::class); // apiResource sudah mencakup crud keseluruhan

    Route::get('/office/{officeSpace:slug}', [OfficeSpaceController::class, 'show']); // Untuk menampilkan detail data office
    Route::apiResource('/offices', OfficeSpaceController::class); // apiResource sudah mencakup crud keseluruhan

    Route::post('/booking-transaction', [BookingTransactionController::class, 'store']); // Untuk menyimpan data booking
    Route::post('/check-booking', [BookingTransactionController::class, 'booking_details']); // Untuk menampilkan detail dari booking transaction
});
