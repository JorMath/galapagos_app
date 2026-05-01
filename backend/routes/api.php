<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BoatController;
use App\Http\Controllers\Api\DepartureController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group.
|
*/

Route::get('/boats', [BoatController::class, 'index']);
Route::get('/boats/{boat}', [BoatController::class, 'show']);
Route::get('/departures', [DepartureController::class, 'index']);