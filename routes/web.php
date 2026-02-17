<?php

use Spatie\Sitemap\Sitemap;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebController;

Route::get('/', [WebController::class, 'inicio'])->name('inicio');
