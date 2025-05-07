<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Videojuego;

class VideojuegoController extends Controller
{
    public function index()
    {
        $videojuegos = Videojuego::all();
        return view('catalogo', compact('videojuegos'));
    }
}
