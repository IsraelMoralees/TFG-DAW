@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-4">
  <!-- Cabecera de la clave -->
  <h1 class="text-white text-3xl font-bold mb-6">
    Key #{{ $key->id }} de {{ $videojuego->titulo }}
  </h1>

  <!-- Datos de la clave -->
  <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl shadow-xl p-6 space-y-4 mb-6">
    <p class="text-gray-300">
      <strong>Código:</strong> <span class="text-white">{{ $key->key_code }}</span>
    </p>
    <p class="text-gray-300">
      <strong>Vendida:</strong>
      @if($key->sold)
        <span class="inline-block bg-green-600 text-white text-sm font-semibold px-2 py-1 rounded-full">
          Sí
        </span>
      @else
        <span class="inline-block bg-gray-500 text-white text-sm font-semibold px-2 py-1 rounded-full">
          No
        </span>
      @endif
    </p>
    <p class="text-gray-300">
      <strong>Creada:</strong> <span class="text-white">{{ $key->created_at->format('Y-m-d H:i') }}</span>
    </p>
    <p class="text-gray-300">
      <strong>Actualizada:</strong> <span class="text-white">{{ $key->updated_at->format('Y-m-d H:i') }}</span>
    </p>
  </div>

  <!-- Botones de acción -->
  <div class="flex space-x-4">
    <a href="{{ route('admin.videojuegos.keys.index', $videojuego) }}"
       class="inline-block bg-gradient-to-r from-gray-600 to-gray-700 
              text-white font-semibold px-4 py-2 rounded-2xl shadow-lg 
              hover:from-gray-500 hover:to-gray-600 transform transition duration-200">
      ← Volver
    </a>
    <a href="{{ route('admin.keys.edit', $key) }}"
       class="inline-block bg-gradient-to-r from-purple-500 to-pink-500 
              text-white font-semibold px-4 py-2 rounded-2xl shadow-lg 
              hover:from-pink-500 hover:to-red-500 transform transition duration-200">
      Editar
    </a>
  </div>
</div>
@endsection
