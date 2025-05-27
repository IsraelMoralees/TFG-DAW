@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-semibold text-gray-900 dark:text-gray-100 mb-6">
        Catálogo de Videojuegos
    </h1>

    @if($videojuegos->count())
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($videojuegos as $juego)
                <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden flex flex-col">
                    <div class="h-48 bg-gray-100 dark:bg-gray-700">
                        <img src="{{ $juego->imagen }}"
                             alt="{{ $juego->titulo }}"
                             class="w-full h-full object-cover">
                    </div>
                    <div class="p-4 flex-1 flex flex-col">
                        <h2 class="text-xl font-medium text-gray-800 dark:text-gray-200 mb-2">
                            {{ $juego->titulo }}
                        </h2>
                        <p class="text-gray-600 dark:text-gray-400 text-sm mb-4 flex-1">
                            {{ \Illuminate\Support\Str::limit($juego->descripcion, 100) }}
                        </p>
                        <div class="text-gray-700 dark:text-gray-300 text-sm mb-4 space-y-1">
                            <p><span class="font-semibold">Plataforma:</span> {{ $juego->plataforma }}</p>
                            <p><span class="font-semibold">Precio:</span> €{{ number_format($juego->precio, 2) }}</p>
                        </div>
                        <a href="{{ route('catalogo.show', $juego) }}"
                           class="mt-auto inline-block bg-indigo-600 hover:bg-indigo-700 text-white text-center py-2 rounded-md transition">
                            Ver detalles
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $videojuegos->links() }}
        </div>
    @else
        <p class="text-gray-600 dark:text-gray-400">No hay videojuegos disponibles.</p>
    @endif
</div>
@endsection
