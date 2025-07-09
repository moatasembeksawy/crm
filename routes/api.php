<?php

use Illuminate\Support\Facades\Route;
use App\CRM\Http\Controllers\Api\V1\CustomerController;
use App\CRM\Http\Controllers\Api\V1\NoteController;
use App\Http\Controllers\AuthController;

Route::prefix('v1')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::apiResource('customers', CustomerController::class);
        Route::post('customers/{customer}/notes', [NoteController::class, 'store']);
        Route::delete('customers/{customer}/notes/{note}', [NoteController::class, 'destroy']);
    });
});
