<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BloodDonationController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register', [AuthController::class, 'register'])->name('register');


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/blood-donation', [BloodDonationController::class, 'store'])->name('blood-donation.store');
    Route::get('/user', [UserController::class, 'show'])->name('user.show');
    Route::put('/user/update', [UserController::class, 'update'])->name('user.update');
    Route::post('/logout', [AuthController::class, 'logout']);
});