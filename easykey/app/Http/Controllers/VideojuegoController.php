<?php

namespace App\Http\Controllers;

use App\Models\Videojuego;
use Illuminate\Http\Request;

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

        // 4) Filtro de disponibilidad
        if (($disp = $request->input('disponible')) !== null) {
            if ($disp === '1') {
                // “Disponible”: al menos 1 key sin vender
                $query->whereHas('keys', function ($q) {
                    $q->where('sold', false);
                });
            }
            elseif ($disp === '0') {
                // “Agotado”: no haya ninguna key sin vender
                $query->whereDoesntHave('keys', function ($q) {
                    $q->where('sold', false);
                });
            }
        }

        // 5) Cargar el contador de keys sin vender en cada videojuego
        $query->withCount(['keys as stock_count' => function($q) {
            $q->where('sold', false);
        }]);

        // 6) Ordenar y paginar, manteniendo todos los filtros en la URL
        $videojuegos = $query
            ->orderBy('created_at', 'desc')
            ->paginate(12)
            ->appends($request->only([
                'q', 'plataforma', 'min_price', 'max_price', 'disponible'
            ]));

        // 7) Obtener lista de plataformas para el dropdown
        $platforms = Videojuego::select('plataforma')
                         ->distinct()
                         ->pluck('plataforma');

        return view('catalogo', compact('videojuegos', 'platforms'));
    }

    public function show(Videojuego $videojuego)
    {
        $relacionados = Videojuego::where('plataforma', $videojuego->plataforma)
                          ->where('id', '!=', $videojuego->id)
                          ->inRandomOrder()
                          ->take(4)
                          ->get();

        // Verificar si hay al menos 1 key sin vender
        $inStock = \App\Models\Key::where('videojuego_id', $videojuego->id)
                      ->where('sold', false)
                      ->exists();

        return view('catalogo.show', compact('videojuego', 'relacionados', 'inStock'));
    }
}
