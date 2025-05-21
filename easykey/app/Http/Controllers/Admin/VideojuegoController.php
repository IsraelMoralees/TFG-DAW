<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Videojuego;
use Illuminate\Http\Request;

class VideojuegoController extends Controller
{
    public function index()
    {
        $videojuegos = Videojuego::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.videojuegos.index', compact('videojuegos'));
    }

    public function create()
    {
        return view('admin.videojuegos.create');
    }

    public function store(Request $request)
    {
        // 1) Validar datos, incluido el nuevo campo 'imagen_file'
        $data = $request->validate([
            'titulo'       => 'required|max:255',
            'descripcion'  => 'required',
            'plataforma'   => 'required|max:100',
            'precio'       => 'required|numeric|min:0',
            'imagen'       => 'nullable|url',
            'imagen_file'  => 'nullable|image|max:2048', // ≤ 2MB
        ]);

        // 2) Si viene un fichero, guardarlo en storage/app/public/videojuegos
        if ($request->hasFile('imagen_file')) {
            $path = $request->file('imagen_file')
                ->store('videojuegos', 'public');
            // 3) Ajustar la URL pública
            $data['imagen'] = 'storage/' . $path;
        }

        // 4) Crear el registro
        Videojuego::create($data);

        return redirect()
            ->route('admin.videojuegos.index')
            ->with('success', 'Videojuego creado correctamente.');
    }

    public function show(Videojuego $videojuego)
    {
        return view('admin.videojuegos.show', compact('videojuego'));
    }

    public function edit(Videojuego $videojuego)
    {
        return view('admin.videojuegos.edit', compact('videojuego'));
    }

    public function update(Request $request, Videojuego $videojuego)
    {
        $data = $request->validate([
            'titulo'       => 'required|max:255',
            'descripcion'  => 'required',
            'plataforma'   => 'required|max:100',
            'precio'       => 'required|numeric|min:0',
            'imagen'       => 'nullable|url',
            'imagen_file'  => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('imagen_file')) {
            $path = $request->file('imagen_file')
                ->store('videojuegos', 'public');
            $data['imagen'] = 'storage/' . $path;
        }

        $videojuego->update($data);

        return redirect()
            ->route('admin.videojuegos.index')
            ->with('success', 'Videojuego actualizado correctamente.');
    }

    public function destroy(Videojuego $videojuego)
    {
        $videojuego->delete();

        return redirect()
            ->route('admin.videojuegos.index')
            ->with('success', 'Videojuego eliminado correctamente.');
    }
}
