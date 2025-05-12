<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VideojuegoController;
use App\Http\Controllers\Admin\VideojuegoController as AdminVideojuegoController;
use App\Http\Controllers\Admin\KeyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PurchaseController;

// Ruta al dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Rutas de edición de perfil (Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 1) Lanzar el checkout de Stripe
    Route::post(
        '/catalogo/{videojuego}/checkout',
        [PurchaseController::class, 'checkout']
    )->name('purchase.checkout');

    // 2) Procesar la redirección de “éxito” tras pago
    Route::get(
        '/purchase/success/{videojuego}',
        [PurchaseController::class, 'success']
    )->name('purchase.success');

    // 3) Mostrar el historial de compras
    Route::get(
        '/mis-compras',
        [PurchaseController::class, 'index']
    )->name('purchase.index');
});

// Catálogo público…
Route::get('/catalogo', [VideojuegoController::class, 'index'])->name('catalogo');
Route::get('/catalogo/{videojuego}', [VideojuegoController::class, 'show'])->name('catalogo.show');

// Rutas para el panel de administración de videojuegos
Route::middleware(['auth', AdminMiddleware::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('videojuegos', AdminVideojuegoController::class);
    });

// Rutas para el panel de administración de keys
Route::middleware(['auth', AdminMiddleware::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('videojuegos', AdminVideojuegoController::class);

        // RUTAS PARA CLAVES
        Route::resource('videojuegos.keys', KeyController::class)
            ->shallow();
    });

// Rutas para la autenticación
require __DIR__ . '/auth.php';
