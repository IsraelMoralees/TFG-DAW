{{-- resources/views/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-12 px-4">
  <div class="flex flex-col md:flex-row bg-gray-800 dark:bg-gray-900 rounded-2xl shadow-xl overflow-hidden">
    
    {{-- ========== COLUMNA IZQUIERDA (Imagen) ========== --}}
    <div class="md:w-1/2 w-full">
      @if($videojuego->imagen)
        <img
          src="{{ asset($videojuego->imagen) }}"
          alt="{{ $videojuego->titulo }}"
          class="w-full h-80 md:h-full object-cover"
        >
      @else
        <div class="w-full h-80 md:h-full bg-gray-700 flex items-center justify-center">
          <span class="text-gray-400">Sin imagen disponible</span>
        </div>
      @endif
    </div>

    {{-- ========== COLUMNA DERECHA (Información) ========== --}}
    <div class="md:w-1/2 w-full p-6 md:p-12 flex flex-col justify-between space-y-6">
      
      {{-- Título --}}
      <h1 class="text-3xl md:text-4xl font-display text-purple-300">
        {{ $videojuego->titulo }}
      </h1>

      {{-- Metadatos --}}
      <div class="flex flex-wrap items-center space-x-6 text-gray-400 text-sm md:text-base">
        {{-- Icono PC --}}
        <span class="flex items-center space-x-2">
          <!-- SVG PC -->
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
               viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9.75 17L9 20h6l-.75-3m3.75-8.75V4.75A2.75 2.75 0 0016.25 2H7.75A2.75 2.75 0 005 4.75v8.5M3 13h18"/>
          </svg>
          <span>PC</span>
        </span>

        {{-- Icono Stock --}}
        <span class="flex items-center space-x-2">
          <!-- SVG Check -->
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-400" fill="none"
               viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M5 13l4 4L19 7"/>
          </svg>
          <span>En stock</span>
        </span>

        {{-- Icono Digital --}}
        <span class="flex items-center space-x-2">
          <!-- SVG Cloud Download -->
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-400" fill="none"
               viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M8 16h8M8 12h8m-8-4h8M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5"/>
          </svg>
          <span>Descarga digital</span>
        </span>
      </div>

      {{-- Descripción --}}
      <p class="text-gray-300 leading-relaxed">
        {{ $videojuego->descripcion }}
      </p>

      {{-- Selector de edición --}}
      <select class="w-full md:w-2/3 bg-gray-700 border border-gray-600 rounded-md px-4 py-2 text-white">
        <option>Standard Edición</option>
        <option>Deluxe Edición</option>
      </select>

      {{-- Precio + CTA --}}
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-4 sm:space-y-0">
        <div class="space-x-2 text-xl md:text-2xl text-white">
          <span class="line-through text-gray-500">€50</span>
          <span class="text-red-500">-43%</span>
          <span class="font-bold text-3xl">28.59 €</span>
        </div>

        <div class="flex space-x-4 w-full sm:w-auto">
          {{-- Corazón (wishlist) --}}
          <button class="p-3 bg-purple-700 rounded-lg hover:bg-purple-600 transition">
            <!-- SVG corazón -->
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4.318 6.318a4.5 4.5 0 016.364 0L12
                       7.636l1.318-1.318a4.5 4.5 0
                       116.364 6.364L12 21.364l-7.682-7.682a4.5 4.5 0
                       010-6.364z"/>
            </svg>
          </button>

          {{-- Añadir al carrito --}}
          <form action="{{ route('cart.add', $videojuego) }}" method="POST">
            @csrf
            <button type="submit"
                    class="px-4 py-2 bg-purple-500 hover:bg-purple-600 text-white font-medium
                           rounded-lg transition">
              Añadir a la cesta
            </button>
          </form>

          {{-- Comprar ahora --}}
          <form action="{{ route('purchase.checkout', $videojuego) }}" method="POST" class="flex-1">
            @csrf
            <button type="submit"
                    class="w-full py-3 bg-gradient-to-r from-purple-600 to-pink-500
                           hover:from-purple-700 hover:to-pink-600 text-white font-medium
                           rounded-lg transition">
              Comprar ahora
            </button>
          </form>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection
