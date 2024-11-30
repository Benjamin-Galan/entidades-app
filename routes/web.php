<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EntityController;

Route::get('/', [EntityController::class, 'index']);
Route::post('/procesar', [EntityController::class, 'procesar']);
