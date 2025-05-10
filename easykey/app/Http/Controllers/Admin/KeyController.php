<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Videojuego;
use App\Models\Key;
use Illuminate\Http\Request;

class KeyController extends Controller
{
    /**
     * Muestra una lista paginada de las keys asociadas a un videojuego.
     */
    public function index(Videojuego $videojuego)
    {
        $keys = $videojuego->keys()->paginate(20);
        return view('admin.keys.index', compact('videojuego', 'keys'));
    }

    /**
     * Muestra el formulario para crear una nueva key.
     */
    public function create(Videojuego $videojuego)
    {
        return view('admin.keys.create', compact('videojuego'));
    }

    /**
     * Guarda una nueva key en el almacenamiento.
     * Valida la key y la guarda en la base de datos.
     */
    public function store(Request $request, Videojuego $videojuego)
    {
        $data = $request->validate([
            'key_code' => 'required|string|unique:keys,key_code',
            'sold'     => 'sometimes|boolean',
        ]);

        $data['videojuego_id'] = $videojuego->id;
        Key::create($data);

        return redirect()
            ->route('admin.videojuegos.keys.index', $videojuego)
            ->with('success', 'Key creada correctamente.');
    }

    /**
     * ver la key especificada.
     * Muestra los detalles de la key.
     */
    public function show(Key $key)
    {
        $videojuego = $key->videojuego;
        return view('admin.keys.show', compact('videojuego', 'key'));
    }

    /**
     * editar la key especificada.
     * Muestra el formulario para editar la key.
     */
    public function edit(Key $key)
    {
        $videojuego = $key->videojuego;
        return view('admin.keys.edit', compact('videojuego', 'key'));
    }

    /**
     * actualizar la key especificada en el almacenamiento.
     */
    public function update(Request $request, Key $key)
    {
        $data = $request->validate([
            'key_code' => 'required|string|unique:keys,key_code,' . $key->id,
            'sold'     => 'sometimes|boolean',
        ]);

        $key->update($data);

        return redirect()
            ->route('admin.videojuegos.keys.index', $key->videojuego)
            ->with('success', 'Key actualizada correctamente.');
    }

    /**
     * Borrar la key especificada.
     */
    public function destroy(Key $key)
    {
        $videojuego = $key->videojuego;
        $key->delete();

        return redirect()
            ->route('admin.videojuegos.keys.index', $videojuego)
            ->with('success', 'Key eliminada correctamente.');
    }
}
