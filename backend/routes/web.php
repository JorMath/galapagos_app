<?php

use App\Http\Controllers\Admin\BoatController;
use App\Http\Controllers\Admin\DepartureController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Rutas de administración - protegidas con auth
    Route::resource('/admin/boats', BoatController::class);
    Route::resource('/admin/departures', DepartureController::class);
});

require __DIR__.'/auth.php';
