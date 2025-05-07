<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VideojuegoController;
use App\Http\Controllers\Admin\VideojuegoController as AdminVideojuegoController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/catalogo', [VideojuegoController::class, 'index'])->name('catalogo');

Route::middleware(['auth','admin'])
     ->prefix('admin')
     ->name('admin.')
     ->group(function(){
         Route::resource('videojuegos', AdminVideojuegoController::class);
});

require __DIR__.'/auth.php';
