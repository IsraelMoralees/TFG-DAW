@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-600 to-indigo-800 py-12 px-4 sm:px-6 lg:px-8">
    <!-- Título centrado -->
    <h1 class="text-4xl font-extrabold text-white text-center">
        Catálogo de Videojuegos
    </h1>
    <!-- Slogan debajo -->
    <p class="mt-2 text-lg text-gray-200 text-center mb-10">
        Encuentra tu próxima aventura gamer
    </p>

    @if($videojuegos->count())
        <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($videojuegos as $juego)
                <div class="bg-white/10 dark:bg-black/30 backdrop-blur-lg border border-white/20 shadow-xl rounded-2xl overflow-hidden flex flex-col transform hover:scale-105 transition duration-300">
                    <div class="relative h-48 overflow-hidden">
                        <img src="{{ $juego->imagen }}"
                             alt="{{ $juego->titulo }}"
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    </div>
                    <div class="p-6 flex-1 flex flex-col">
                        <h2 class="text-2xl font-bold text-white mb-2">
                            {{ $juego->titulo }}
                        </h2>
                        <p class="text-gray-200 text-sm mb-4 flex-1">
                            {{ \Illuminate\Support\Str::limit($juego->descripcion, 100) }}
                        </p>
                        <div class="text-gray-100 text-sm mb-6 space-y-1">
                            <p><span class="font-semibold">Plataforma:</span> {{ $juego->plataforma }}</p>
                            <p><span class="font-semibold">Precio:</span> €{{ number_format($juego->precio, 2) }}</p>
                        </div>
                        <a href="{{ route('catalogo.show', $juego) }}"
                           class="mt-auto inline-block bg-gradient-to-r from-indigo-500 to-purple-500 hover:from-indigo-600 hover:to-purple-600 text-white font-medium text-center py-2 rounded-lg transition duration-200">
                            Ver detalles
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-12 flex justify-center">
            {{ $videojuegos->links('vendor.pagination.tailwind') }}
        </div>
    @else
        <p class="text-gray-200 text-center">No hay videojuegos disponibles.</p>
    @endif
</div>
<!-- Footer -->
<footer class="bg-gradient-to-r from-purple-600 to-indigo-600 py-6">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <p class="text-gray-200 text-sm">© {{ date('Y') }} EasyKey. Todos los derechos reservados.</p>

    <div class="mt-4 flex justify-center space-x-4">
      <a href="/" class="text-gray-200 hover:text-white">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
          <path d="M22 12c0-5.522-4.477-10-10-10S2 6.478 2 12c0 4.991 3.656 9.128 8.438 9.878v-6.987H7.898v-2.89h2.54V9.797c0-2.507 1.492-3.89 3.777-3.89 1.094 0 2.238.197 2.238.197v2.459h-1.261c-1.243 0-1.63.772-1.63 1.562v1.875h2.773l-.443 2.89h-2.33v6.987C18.344 21.128 22 16.991 22 12z"/>
        </svg>
      </a>
      <a href="/" class="text-gray-200 hover:text-white">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
          <path d="M22.46 6c-.77.35-1.6.58-2.46.69a4.3 4.3 0 001.88-2.37 8.59 8.59 0 01-2.72 1.04 4.28 4.28 0 00-7.29 3.9A12.12 12.12 0 013 5.9a4.28 4.28 0 001.33 5.72 4.24 4.24 0 01-1.94-.54v.05a4.28 4.28 0 003.43 4.2 4.28 4.28 0 01-1.93.07 4.28 4.28 0 004 2.97A8.58 8.58 0 012 19.54 12.1 12.1 0 008.29 21c7.55 0 11.68-6.26 11.68-11.68l-.01-.53A8.36 8.36 0 0022.46 6z"/>
        </svg>
      </a>
      <a href="/" class="text-gray-200 hover:text-white">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
          <path d="M7.75 2A5.75 5.75 0 002 7.75v8.5A5.75 5.75 0 007.75 22h8.5A5.75 5.75 0 0022 16.25v-8.5A5.75 5.75 0 0016.25 2h-8.5zM12 7.5a4.5 4.5 0 110 9 4.5 4.5 0 010-9zm5.5-.25a1.25 1.25 0 11-2.5 0 1.25 1.25 0 012.5 0zM12 9.5a2.5 2.5 0 100 5 2.5 2.5 0 000-5z"/>
        </svg>
      </a>
    </div>
  </div>
</footer>
@endsection
