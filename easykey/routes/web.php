<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VideojuegoController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\Admin\VideojuegoController   as AdminVideojuegoController;
use App\Http\Controllers\Admin\KeyController         as AdminKeyController;
use App\Http\Controllers\Admin\UserController        as AdminUserController;
use Illuminate\Support\Facades\Route;

// ----------------------------------------------------
// Dashboard
// ----------------------------------------------------
Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware(['auth','verified'])
    ->name('dashboard');

// ----------------------------------------------------
// Perfil de usuario (incluye historial de compras + Stripe)
// ----------------------------------------------------
Route::middleware('auth')->group(function () {
    // Edición de perfil
    Route::get   ('/profile',                 [ProfileController::class, 'edit'])    ->name('profile.edit');
    Route::patch ('/profile',                 [ProfileController::class, 'update'])  ->name('profile.update');
    Route::delete('/profile',                 [ProfileController::class, 'destroy']) ->name('profile.destroy');

    // Stripe Checkout
    Route::post('/catalogo/{videojuego}/checkout',    [PurchaseController::class, 'checkout'])
         ->name('purchase.checkout');
    Route::get ('/purchase/success/{videojuego}',    [PurchaseController::class, 'success'])
         ->name('purchase.success');

    // Historial de compras
    Route::get('/mis-compras',                       [PurchaseController::class, 'index'])
         ->name('purchase.index');
});

// ----------------------------------------------------
// Catálogo público
// ----------------------------------------------------
Route::get('/catalogo',               [VideojuegoController::class, 'index']) ->name('catalogo');
Route::get('/catalogo/{videojuego}',  [VideojuegoController::class, 'show'])  ->name('catalogo.show');

// ----------------------------------------------------
// Panel de administración (único grupo)
// ----------------------------------------------------
Route::middleware(['auth', AdminMiddleware::class])
     ->prefix('admin')
     ->name('admin.')
     ->group(function () {
         // 1) CRUD de Videojuegos
         Route::resource('videojuegos',   AdminVideojuegoController::class);

         // 2) CRUD de Keys (anidado bajo videojuego)
         Route::resource('videojuegos.keys', AdminKeyController::class)
              ->shallow();

         // 3) CRUD de Usuarios
         Route::get   ('users',              [AdminUserController::class, 'index'])   ->name('users.index');
         Route::get   ('users/{user}/edit',  [AdminUserController::class, 'edit'])    ->name('users.edit');
         Route::put   ('users/{user}',       [AdminUserController::class, 'update'])  ->name('users.update');
         Route::delete('users/{user}',       [AdminUserController::class, 'destroy']) ->name('users.destroy');
     });

// ----------------------------------------------------
// Auth routes (Breeze / Fortify / etc.)
// ----------------------------------------------------
require __DIR__.'/auth.php';
