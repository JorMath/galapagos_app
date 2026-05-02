<?php

use App\Http\Controllers\Api\BoatController;
use App\Http\Controllers\Api\DepartureController;
use App\Http\Controllers\Api\ItineraryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Rutas API públicas - no requieren autenticación
|
*/

// Barcos
Route::get('/barcos', [BoatController::class, 'index']);
Route::get('/barcos/{barco}', [BoatController::class, 'show']);

// Salidas
Route::get('/salidas', [DepartureController::class, 'index']);

// Itinerarios - consulta por timezone
Route::get('/itinerarios/consulta', [ItineraryController::class, 'consulta']);
