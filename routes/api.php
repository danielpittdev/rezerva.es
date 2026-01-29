<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;

Route::prefix('/v1')->middleware('auth:sanctum')->group(function () {
    Route::get('/test', [ApiController::class, 'test']);
});
