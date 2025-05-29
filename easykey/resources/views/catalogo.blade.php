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
@endsection
