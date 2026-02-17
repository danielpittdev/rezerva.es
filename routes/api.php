<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
  return response()->json([
    'api' => true,
    'alive' => true,
    'version' => '1.1.1'
  ]);
});

Route::apiResource('reserva')->name('reserva');
