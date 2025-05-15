<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Videojuego;

class VideojuegoController extends Controller
{
    public function index(Request $request)
    {
        $query = Videojuego::query();

        // 1) Búsqueda por título
        if ($term = $request->input('q')) {
            $query->where('titulo', 'like', "%{$term}%");
        }

        // 2) Filtro por plataforma
        if ($plat = $request->input('plataforma')) {
            $query->where('plataforma', $plat);
        }

        // 3) Rango de precio
        if ($min = $request->input('min_price')) {
            $query->where('precio', '>=', floatval($min));
        }
        if ($max = $request->input('max_price')) {
            $query->where('precio', '<=', floatval($max));
        }

        // 4) Orden y paginación
        $videojuegos = $query
            ->orderBy('created_at','desc')
            ->paginate(12)
            // Mantener los parámetros en los links de paginación
            ->appends($request->only(['q','plataforma','min_price','max_price']));

        // Lista de plataformas para rellenar el select
        $platforms = Videojuego::select('plataforma')->distinct()->pluck('plataforma');

        return view('catalogo', compact('videojuegos','platforms'));
    }

}
