<?php

use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\AuthAdminController;
use App\Http\Controllers\UserController;
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

//----------------------------User Routes--------------------------------
Route::middleware('auth:sanctum')->group(function () {
    // Get a list of all users (for admin or authorized users)
    Route::get('/users', [UserController::class, 'index']); // Get all users

    // Get a specific user by ID
    Route::get('/users/{id}', [UserController::class, 'show']); // Get a specific user by ID

    // Create a new user (requires admin or authorized role)
    Route::post('/users', [UserController::class, 'store']); // Create a new user

    // Update an existing user (by user ID)
    Route::put('/users/{id}', [UserController::class, 'update']); // Update a user

    // Delete a user (by user ID)
    Route::delete('/users/{id}', [UserController::class, 'destroy']); // Delete a user
});