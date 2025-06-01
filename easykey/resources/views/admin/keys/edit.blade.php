@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-4">
  <!-- Título de la página -->
  <h1 class="text-white text-3xl font-bold mb-6">
    Editar Key #{{ $key->id }} ({{ $videojuego->titulo }})
  </h1>

  <!-- Formulario con estilo -->
  <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl shadow-xl p-6">
    <form action="{{ route('admin.keys.update', $key) }}" method="POST" class="space-y-6">
      @csrf 
      @method('PUT')

      {{-- Campos del formulario --}}
      @include('admin.keys._form')

      <!-- Botones de acción -->
      <div class="flex space-x-4">
        <button
          type="submit"
          class="bg-gradient-to-r from-indigo-500 to-purple-500 
                 text-white font-semibold px-4 py-2 rounded-2xl shadow-lg 
                 hover:from-purple-500 hover:to-pink-500 transform transition duration-200"
        >
          Actualizar
        </button>
        <a
          href="{{ route('admin.videojuegos.keys.index', $videojuego) }}"
          class="bg-gradient-to-r from-gray-600 to-gray-700 
                 text-white font-semibold px-4 py-2 rounded-2xl shadow-lg 
                 hover:from-gray-500 hover:to-gray-600 transform transition duration-200"
        >
          Cancelar
        </a>
      </div>
    </form>
  </div>
</div>
@endsection
