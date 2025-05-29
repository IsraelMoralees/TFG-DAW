{{-- resources/views/catalogo/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

  {{-- ======== FICHA PRINCIPAL ======== --}}
  <div class="flex flex-col md:flex-row bg-white/10 backdrop-blur-lg border border-white/20 shadow-xl rounded-2xl overflow-hidden">
    {{-- Columna Imagen --}}
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

    {{-- Columna Información --}}
    <div class="md:w-1/2 w-full p-6 md:p-12 flex flex-col justify-between">
      {{-- Título --}}
      <h1 class="text-3xl md:text-4xl font-bold text-white mb-4">
        {{ $videojuego->titulo }}
      </h1>

      {{-- Plataforma --}}
      @php
        $iconos = [
          'PC'     => 'M9.75 17L9 20h6l-.75-3m3.75-8.75V4.75A2.75 2.75 0 0016.25 2H7.75A2.75 2.75 0 005 4.75v8.5M3 13h18',
          'Xbox'   => 'M12 2a10 10 0 100 20 10 10 0 000-20z',
          'PS5'    => 'M8 2h8v20H8z',
          'Switch' => 'M6 4h12v16H6z',
        ];
        $plataforma = $videojuego->plataforma;
        $svgPath    = $iconos[$plataforma] ?? $iconos['PC'];
      @endphp
      <div class="flex items-center text-gray-300 mb-6 space-x-3">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
             viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="{{ $svgPath }}" />
        </svg>
        <span>
          Plataforma: <strong class="text-white">{{ $plataforma }}</strong>
        </span>
      </div>

      {{-- Descripción --}}
      <p class="text-gray-200 leading-relaxed mb-8">
        {{ $videojuego->descripcion }}
      </p>

      {{-- Precio --}}
      <div class="mb-8">
        <span class="text-2xl text-white font-bold">
          €{{ number_format($videojuego->precio, 2) }}
        </span>
      </div>

      {{-- Botones de acción --}}
      <div class="flex flex-col sm:flex-row sm:space-x-4 space-y-4 sm:space-y-0">
        <form action="{{ route('cart.add', $videojuego) }}" method="POST" class="flex-1">
          @csrf
          <button type="submit"
                  class="w-full py-3 bg-gradient-to-r from-indigo-500 to-purple-500
                         hover:from-indigo-600 hover:to-purple-600 text-white
                         font-medium rounded-lg transition">
            Añadir a la cesta
          </button>
        </form>
        <form action="{{ route('purchase.checkout', $videojuego) }}" method="POST" class="flex-1">
          @csrf
          <button type="submit"
                  class="w-full py-3 bg-gradient-to-r from-purple-500 to-pink-500
                         hover:from-purple-600 hover:to-pink-600 text-white
                         font-medium rounded-lg transition">
            Comprar ahora
          </button>
        </form>
      </div>
    </div>
  </div>

  {{-- ======== JUEGOS RELACIONADOS (INLINE-GRID CENTRADO) ======== --}}
  <div class="mt-12 text-center">
    <h2 class="text-2xl font-semibold text-white mb-6">Juegos relacionados</h2>
    <div class="inline-grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
      @foreach($relacionados as $rel)
        <a href="{{ route('catalogo.show', $rel) }}"
           class="w-64 bg-white/10 backdrop-blur-sm border border-white/20
                  rounded-lg overflow-hidden hover:scale-105 transform transition">
          <img src="{{ asset($rel->imagen) }}"
               alt="{{ $rel->titulo }}"
               class="w-full h-32 object-cover">
          <div class="p-3 text-white text-center">
            <h3 class="font-medium">{{ $rel->titulo }}</h3>
            <p class="text-sm text-gray-300">{{ $rel->plataforma }}</p>
          </div>
        </a>
      @endforeach
    </div>
  </div>

</div>
@endsection
