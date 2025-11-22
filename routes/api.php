<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ScheduleController;

// Route Public
Route::get('/schedules', [ScheduleController::class, 'index']);

// Route Private
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
