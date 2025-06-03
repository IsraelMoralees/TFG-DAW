<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Videojuego;

class CartController extends Controller
{
    // 1) Mostrar contenido del carro
    public function index()
    {
        $cart = session('cart', []);
        // Recuperamos los videojuegos completos según las claves del array de sesión
        $items = Videojuego::findMany(array_keys($cart));

        return view('cart.index', compact('items', 'cart'));
    }

    // 2) Añadir un videojuego al carro, recibiendo “quantity” desde el formulario
    public function add(Request $request, Videojuego $videojuego)
    {
        // 1) Validamos que llega “quantity” y sea un entero >= 1
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $qty = (int) $request->input('quantity');

        // 2) (Opcional) Verificar en base de datos que hay stock suficiente
        $available = \App\Models\Key::where('videojuego_id', $videojuego->id)
                        ->where('sold', false)
                        ->count();

        if ($qty > $available) {
            return back()->withErrors([
                'quantity' => "Lo siento, solo quedan {$available} unidad(es) disponibles."
            ]);
        }

        // 3) Tomamos el carrito desde sesión (array id => cantidad)
        $cart = session('cart', []);

        // Si ya existe la entrada para este videojuego, sumamos la nueva cantidad
        // Si no existe, lo inicializamos con $qty
        $cart[$videojuego->id] = ($cart[$videojuego->id] ?? 0) + $qty;

        // 4) Guardamos de nuevo el carrito en sesión
        session(['cart' => $cart]);

        return back()->with('success', "Añadidas {$qty} unidad(es) de “{$videojuego->titulo}” al carrito.");
    }

    // 3) Quitar todo un videojuego del carrito
    public function remove(Videojuego $videojuego)
    {
        $cart = session('cart', []);

        unset($cart[$videojuego->id]);

        session(['cart' => $cart]);

        return back()->with('success', 'Eliminado del carrito');
    }
}
