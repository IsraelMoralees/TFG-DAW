<?php
use App\Http\Middleware\AdminMiddleware;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VideojuegoController;
use App\Http\Controllers\Admin\VideojuegoController as AdminVideojuegoController;
use Illuminate\Support\Facades\Route;

// Ruta al dashboard que tu nav espera
Route::get('/dashboard', function () {
    return view('dashboard');
})
->middleware(['auth','verified'])
->name('dashboard');

// Rutas de edición de perfil (Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Catálogo público…
Route::get('/catalogo', [VideojuegoController::class,'index'])->name('catalogo');
Route::get('/catalogo/{videojuego}', [VideojuegoController::class,'show'])->name('catalogo.show');

Route::middleware(['auth', AdminMiddleware::class])
     ->prefix('admin')
     ->name('admin.')
     ->group(function(){
         Route::resource('videojuegos', AdminVideojuegoController::class);
});


require __DIR__.'/auth.php';