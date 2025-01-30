<?php

use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CoachController;
use Illuminate\Support\Facades\Route;

//----------------------------Authentication Routes For Users--------------------------------
// In routes/web.php or routes/api.php
Route::post('login', [AuthAdminController::class, 'login'])->name('login');

// Register login logout for user
Route::post('/register', [AuthUserController::class, 'register']);
Route::post('/login', [AuthUserController::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthUserController::class, 'logout']);

// Register login logout for admin
Route::post('/Te-Admin-register', [AuthAdminController::class, 'register']);
Route::post('/Admin-login', action: [AuthAdminController::class, 'login']);
Route::middleware('auth:sanctum')->post('/Admin-logout', [AuthAdminController::class, 'logout']);

// Admin Routes
Route::prefix('admins')->group(function () {
    Route::get('/', [AdminController::class, 'index']);       // Display all admins
    Route::post('/', [AdminController::class, 'store']);      // Store new admin
    Route::get('/{admin}', [AdminController::class, 'show']); // Show specific admin
    Route::put('/{admin}', [AdminController::class, 'update']); // Update specific admin
    Route::delete('/{admin}', [AdminController::class, 'destroy']); // Delete specific admin
});

// Coach Routes
Route::prefix('coaches')->group(function () {
    Route::get('/', [CoachController::class, 'index']);       // Display all coaches
    Route::post('/', [CoachController::class, 'store']);      // Store new coach
    Route::get('/{coach}', [CoachController::class, 'show']); // Show specific coach
    Route::put('/{coach}', [CoachController::class, 'update']); // Update specific coach
    Route::delete('/{coach}', [CoachController::class, 'destroy']); // Delete specific coach
});