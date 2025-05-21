{{-- resources/views/catalogo.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
  <h1 class="text-3xl font-bold text-white mb-6">Catálogo de Videojuegos</h1>

  {{-- Grid responsivo: 1 columna en móvil, 2 en md, 3 en lg --}}
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($videojuegos as $juego)
      <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-lg hover:shadow-xl transition-shadow">
        {{-- Imagen --}}
        <img 
          src="{{ $juego->imagen }}" 
          alt="{{ $juego->titulo }}" 
          class="w-full h-48 object-cover"
        >

        <div class="p-4">
          {{-- Título --}}
          <h2 class="text-xl font-semibold text-purple-700 dark:text-purple-300 mb-2">
            {{ $juego->titulo }}
          </h2>

          {{-- Descripción --}}
          <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 h-16 overflow-hidden">
            {{ Str::limit($juego->descripcion, 100) }}
          </p>

          {{-- Plataforma / Precio --}}
          <div class="flex justify-between items-center mb-4">
            <span class="text-sm font-medium text-gray-500 dark:text-gray-400">
              Plataforma: 
              <span class="text-gray-800 dark:text-gray-200">{{ $juego->plataforma }}</span>
            </span>
            <span class="text-lg font-bold text-purple-600 dark:text-purple-400">
              €{{ number_format($juego->precio, 2) }}
            </span>
          </div>

          {{-- Botón --}}
          <a 
            href="{{ route('catalogo.show', $juego) }}" 
            class="block text-center bg-purple-600 hover:bg-purple-700 text-white font-medium py-2 rounded"
          >
            Ver detalles
          </a>
        </div>
      </div>
    @endforeach
  </div>

  {{-- Paginación --}}
  <div class="mt-8">
    {{ $videojuegos->links('vendor.pagination.tailwind') }}
  </div>
</div>
@endsection
