{{-- resources/views/catalogo.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 dark:bg-gray-900 py-8">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-4xl font-bold text-purple-600 dark:text-purple-300 mb-8">Catálogo de Videojuegos</h1>

    {{-- Grid responsivo --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach($videojuegos as $juego)
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow hover:shadow-xl transition-shadow duration-300 overflow-hidden">
        {{-- Imagen --}}
        @if($juego->imagen)
          <img src="{{ asset($juego->imagen) }}" alt="{{ $juego->titulo }}" class="w-full h-48 object-cover">
        @else
          <div class="w-full h-48 bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
            <span class="text-gray-500 dark:text-gray-400">Sin imagen</span>
          </div>
        @endif

        <div class="p-4">
          {{-- Título --}}
          <h2 class="text-2xl font-semibold text-purple-700 dark:text-purple-300 mb-2">{{ $juego->titulo }}</h2>

          {{-- Descripción --}}
          <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 h-16 overflow-hidden">{{ Str::limit($juego->descripcion, 100) }}</p>

          {{-- Plataforma y precio --}}
          <div class="flex items-center justify-between mb-4">
            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">Plataforma: <span class="text-gray-800 dark:text-gray-200">{{ $juego->plataforma }}</span></span>
            <span class="text-lg font-bold text-purple-600 dark:text-purple-400">€{{ number_format($juego->precio, 2) }}</span>
          </div>

          {{-- Botón de detalles --}}
          <a href="{{ route('catalogo.show', $juego) }}" class="w-full inline-block text-center bg-purple-600 hover:bg-purple-700 dark:bg-purple-500 dark:hover:bg-purple-600 text-white font-medium py-2 rounded transition">Ver detalles</a>
        </div>
      </div>
      @endforeach
    </div>

    {{-- Paginación --}}
    <div class="mt-8">
      {{ $videojuegos->links() }}
    </div>
  </div>
</div>
@endsection
