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
        // recuperamos los videojuegos completos
        $items = Videojuego::findMany(array_keys($cart));
        return view('cart.index', compact('items', 'cart'));
    }

    // 2) Añadir un videojuego al carro
    public function add(Videojuego $videojuego)
    {
        $cart = session('cart', []);

        // si ya existe aumentamos cantidad
        $cart[$videojuego->id] = ($cart[$videojuego->id] ?? 0) + 1;

        session(['cart' => $cart]);

        return back()->with('success', 'Añadido al carrito');
    }

    // 3) Quitar uno o todo
    public function remove(Videojuego $videojuego)
    {
        $cart = session('cart', []);

        unset($cart[$videojuego->id]);

        session(['cart' => $cart]);

        return back()->with('success', 'Eliminado del carrito');
    }
}
