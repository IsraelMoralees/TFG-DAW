<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Videojuego;
use Illuminate\Http\Request;

class VideojuegoController extends Controller
{
    public function index()
    {
        // Trae los juegos más recientes, 10 por página
        $videojuegos = Videojuego::orderBy('created_at','desc')->paginate(10);
        return view('admin.videojuegos.index', compact('videojuegos'));
    }

    public function create()
    {
        // Muestra el formulario para crear
        return view('admin.videojuegos.create');
    }

    public function store(Request $request)
    {
        // Valida los datos
        $data = $request->validate([
            'titulo'      => 'required|max:255',
            'descripcion' => 'required',
            'plataforma'  => 'required|max:100',
            'precio'      => 'required|numeric|min:0',
            'imagen'      => 'nullable|url',
        ]);

        // Crea el nuevo videojuego
        Videojuego::create($data);

        // Redirige al listado con mensaje
        return redirect()
            ->route('admin.videojuegos.index')
            ->with('success','Videojuego creado correctamente.');
    }

    public function show(Videojuego $videojuego)
    {
        // Muestra ficha individual
        return view('admin.videojuegos.show', compact('videojuego'));
    }

    public function edit(Videojuego $videojuego)
    {
        // Muestra el formulario de edición
        return view('admin.videojuegos.edit', compact('videojuego'));
    }

    public function update(Request $request, Videojuego $videojuego)
    {
        // Valida los datos
        $data = $request->validate([
            'titulo'      => 'required|max:255',
            'descripcion' => 'required',
            'plataforma'  => 'required|max:100',
            'precio'      => 'required|numeric|min:0',
            'imagen'      => 'nullable|url',
        ]);

        // Actualiza el videojuego
        $videojuego->update($data);

        // Redirige al listado con mensaje
        return redirect()
            ->route('admin.videojuegos.index')
            ->with('success','Videojuego actualizado correctamente.');
    }

    public function destroy(Videojuego $videojuego)
    {
        // Borra el videojuego
        $videojuego->delete();

        // Redirige al listado con mensaje
        return redirect()
            ->route('admin.videojuegos.index')
            ->with('success','Videojuego eliminado correctamente.');
    }
}
