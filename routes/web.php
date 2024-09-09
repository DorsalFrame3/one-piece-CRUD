<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PirateController;

Route::get('/pirates', [PirateController::class, 'index'])->name('pirates.index');
Route::get('/pirates/create', [PirateController::class, 'create'])->name('pirates.create');
Route::post('/pirates', [PirateController::class, 'store'])->name('pirates.store');
Route::get('/pirates/{pirate}', [PirateController::class, 'show'])->name('pirates.show');
Route::get('/pirates/{pirate}/edit', [PirateController::class, 'edit'])->name('pirates.edit');
Route::put('/pirates/{pirate}', [PirateController::class, 'update'])->name('pirates.update');
Route::delete('/pirates/{pirate}', [PirateController::class, 'destroy'])->name('pirates.destroy');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
