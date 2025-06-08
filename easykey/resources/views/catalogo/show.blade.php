@extends('layouts.app')

@section('title', 'Detalle de ' . $videojuego->titulo)

@section('content')
<div class="max-w-6xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
  <div class="flex flex-col md:flex-row bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl shadow-xl overflow-hidden">
    
    {{-- Columna Imagen --}}
    <div class="md:w-1/2 w-full">
      @if($videojuego->imagen)
        <img src="{{ asset($videojuego->imagen) }}" alt="{{ $videojuego->titulo }}" class="w-full h-full object-cover">
      @else
        <div class="w-full h-80 bg-gray-700 flex items-center justify-center">
          <span class="text-gray-400">Sin imagen disponible</span>
        </div>
      @endif
    </div>

    {{-- Columna Información --}}
    <div class="md:w-1/2 w-full p-6 md:p-12 flex flex-col justify-between">
      <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">{{ $videojuego->titulo }}</h1>

      @php
        $iconos = [
          'PC' => 'M9.75 17L9 20h6l-.75-3m3.75-8.75V4.75A2.75 2.75 0 0016.25 2H7.75A2.75 2.75 0 005 4.75v8.5M3 13h18',
          'Xbox' => 'M12 2a10 10 0 100 20 10 10 0 000-20z',
          'PS5' => 'M8 2h8v20H8z',
          'Switch' => 'M6 4h12v16H6z',
        ];
        $plataforma = $videojuego->plataforma;
        $svgPath = $iconos[$plataforma] ?? $iconos['PC'];
      @endphp

      <div class="flex items-center text-gray-300 mb-6 space-x-3">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
             viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $svgPath }}" />
        </svg>
        <span>Plataforma: <strong class="text-white">{{ $plataforma }}</strong></span>
      </div>

      <p class="text-gray-200 leading-relaxed mb-8">{{ $videojuego->descripcion }}</p>

      <div class="mb-4">
        <span class="text-2xl text-white font-bold">€{{ number_format($videojuego->precio, 2) }}</span>
      </div>

      @if($inStock)
        {{-- Selector de cantidad con flecha personalizada derecha --}}
        <div class="relative w-32 mb-6">
          <label for="quantity_cart" class="block text-sm text-gray-300 mb-1">Cantidad a añadir:</label>
          <select
            id="quantity_cart"
            name="quantity"
            form="form-cart"
            class="appearance-none w-full px-3 pr-10 py-2 bg-white/10 border border-white/20 rounded-2xl text-black text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
          >
            @for($i = 1; $i <= $stockCount; $i++)
              <option value="{{ $i }}">{{ $i }}</option>
            @endfor
          </select>
          <div class="pointer-events-none absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
          </div>
          <p class="mt-1 text-xs text-gray-400">Hasta {{ $stockCount }} unidades disponibles</p>
        </div>

        {{-- Botones lado a lado --}}
        <div class="flex flex-row justify-between gap-4 flex-wrap">
          {{-- Añadir al carrito --}}
          <form id="form-cart" action="{{ route('cart.add', $videojuego) }}" method="POST" class="flex-1">
            @csrf
            <input type="hidden" name="quantity" id="quantity_hidden" value="1">
            <button
              type="submit"
              class="w-full py-3 bg-gradient-to-r from-indigo-500 to-purple-500 hover:from-indigo-600 hover:to-purple-600 text-white font-medium rounded-lg transform hover:scale-105 transition duration-200"
            >
              Añadir al carrito
            </button>
          </form>

          {{-- Comprar ahora --}}
          <form action="{{ route('purchase.checkout', $videojuego) }}" method="POST" class="flex-1">
            @csrf
            <button
              type="submit"
              class="w-full py-3 bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white font-medium rounded-lg transform hover:scale-105 transition duration-200"
            >
              Comprar ahora
            </button>
          </form>
        </div>
      @else
        <div class="flex items-center justify-center mt-6">
          <span class="px-4 py-3 bg-red-600 text-white font-semibold rounded-lg">
            Sin stock
          </span>
        </div>
      @endif
    </div>
  </div>

  {{-- Juegos relacionados --}}
  <div class="mt-12 text-center">
    <h2 class="text-2xl font-semibold text-white mb-6">Juegos relacionados</h2>
    <div class="inline-grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 justify-center">
      @foreach($relacionados as $rel)
        <a href="{{ route('catalogo.show', $rel) }}"
           class="w-64 bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl shadow-xl overflow-hidden hover:scale-105 transform transition-transform duration-200">
          @if($rel->imagen)
            <img src="{{ asset($rel->imagen) }}" alt="{{ $rel->titulo }}" class="w-full h-32 object-cover">
          @else
            <div class="w-full h-32 bg-gray-700 flex items-center justify-center">
              <span class="text-gray-400 text-sm">Sin imagen</span>
            </div>
          @endif
          <div class="p-4 text-white text-center">
            <h3 class="font-medium">{{ $rel->titulo }}</h3>
            <p class="text-sm text-gray-300">{{ $rel->plataforma }}</p>
          </div>
        </a>
      @endforeach
    </div>
  </div>
</div>

{{-- Footer --}}
<footer class="bg-gradient-to-r from-purple-600 to-indigo-600 py-6">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <p class="text-gray-200 text-sm">© {{ date('Y') }} EasyKey. Todos los derechos reservados.</p>
    <div class="mt-4 flex justify-center space-x-4">
      <a href="/" class="text-gray-200 hover:text-white">
        {{-- Facebook --}}
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
          <path d="M22 12c0-5.522-4.477-10-10-10S2 6.478 2 12c0 4.991 3.656 9.128 8.438 9.878v-6.987H7.898v-2.89h2.54V9.797c0-2.507 1.492-3.89 3.777-3.89 1.094 0 2.238.197 2.238.197v2.459h-1.261c-1.243 0-1.63.772-1.63 1.562v1.875h2.773l-.443 2.89h-2.33v6.987C18.344 21.128 22 16.991 22 12z"/>
        </svg>
      </a>
      {{-- Twitter --}}
      <a href="/" class="text-gray-200 hover:text-white">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
          <path d="M22.46 6c-.77.35-1.6.58-2.46.69a4.3 4.3 0 001.88-2.37 8.59 8.59 0 01-2.72 1.04 4.28 4.28 0 00-7.29 3.9A12.12 12.12 0 013 5.9a4.28 4.28 0 001.33 5.72 4.24 4.24 0 01-1.94-.54v.05a4.28 4.28 0 003.43 4.2 4.28 4.28 0 01-1.93.07 4.28 4.28 0 004 2.97A8.58 8.58 0 012 19.54 12.1 12.1 0 008.29 21c7.55 0 11.68-6.26 11.68-11.68l-.01-.53A8.36 8.36 0 0022.46 6z"/>
        </svg>
      </a>
      {{-- Instagram --}}
      <a href="/" class="text-gray-200 hover:text-white">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
          <path d="M7.75 2A5.75 5.75 0 002 7.75v8.5A5.75 5.75 0 007.75 22h8.5A5.75 5.75 0 0022 16.25v-8.5A5.75 5.75 0 0016.25 2h-8.5zM12 7.5a4.5 4.5 0 110 9 4.5 4.5 0 010-9zm5.5-.25a1.25 1.25 0 11-2.5 0 1.25 1.25 0 012.5 0zM12 9.5a2.5 2.5 0 100 5 2.5 2.5 0 000-5z"/>
        </svg>
      </a>
    </div>
  </div>
</footer>

{{-- JS: sincronizar cantidad seleccionada --}}
<script>
  const select = document.getElementById('quantity_cart');
  const hidden = document.getElementById('quantity_hidden');
  if (select && hidden) {
    select.addEventListener('change', () => {
      hidden.value = select.value;
    });
  }
</script>
@endsection
