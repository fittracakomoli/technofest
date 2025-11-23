<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\Auth\RegisterController;
use App\Http\Controllers\V1\Auth\AuthenticationController;

Route::prefix('v1')->group(function () {
    Route::get('/status', function () {
        return response()->json(['status' => 'API is running']);
    });

    Route::post('/register', [RegisterController::class, 'store']);
    Route::post('/login', [AuthenticationController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/profile', [AuthenticationController::class, 'user']);
        Route::post('/logout', [AuthenticationController::class, 'logout']);

        Route::middleware('role:admin')->prefix('admin')->group(function () {
            Route::get('/dashboard', function () {
                return response()->json(['message' => 'Welcome to the admin dashboard']);
            });
        });

        Route::middleware('role:organizer')->prefix('organizer')->group(function () {
            Route::get('/dashboard', function () {
                return response()->json(['message' => 'Welcome to the organizer dashboard']);
            });
        });
        
        Route::middleware('role:customer')->prefix('customer')->group(function () {
            Route::get('/dashboard', function () {
                return response()->json(['message' => 'Welcome to the customer dashboard']);
            });
        });

    });
});
