{{-- resources/views/catalogo/show.blade.php --}}
@extends('layouts.app')

@section('title', 'Detalle de ' . $videojuego->titulo)

@section('content')
<div class="max-w-6xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

  {{-- ======== FICHA PRINCIPAL ======== --}}
  <div class="flex flex-col md:flex-row bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl shadow-xl overflow-hidden">
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

      {{-- Si hay stock, mostramos los botones; si no, sólo “Sin stock” --}}
      @if($inStock)
        <div class="flex flex-col sm:flex-row sm:space-x-4 space-y-4 sm:space-y-0">
          {{-- Añadir a la cesta --}}
          <form action="{{ route('cart.add', $videojuego) }}" method="POST" class="flex-1">
            @csrf
            <button id="btnAddCart" type="submit"
                    class="w-full py-3 bg-gradient-to-r from-indigo-500 to-purple-500
                           hover:from-indigo-600 hover:to-purple-600 text-white
                           font-medium rounded-lg transition-transform duration-200">
              Añadir a la cesta
            </button>
          </form>

          {{-- Comprar ahora --}}
          <form action="{{ route('purchase.checkout', $videojuego) }}" method="POST" class="flex-1">
            @csrf
            <button id="btnBuyNow" type="submit"
                    class="w-full py-3 bg-gradient-to-r from-purple-500 to-pink-500
                           hover:from-purple-600 hover:to-pink-600 text-white
                           font-medium rounded-lg transition-transform duration-200">
              Comprar ahora
            </button>
          </form>
        </div>
      @else
        <div class="flex items-center justify-center">
          <span class="px-4 py-3 bg-red-600 text-white font-semibold rounded-lg">
            Sin stock
          </span>
        </div>
      @endif
    </div>
  </div>

  {{-- ======== JUEGOS RELACIONADOS (INLINE-GRID CENTRADO) ======== --}}
  <div class="mt-12 text-center">
    <h2 class="text-2xl font-semibold text-white mb-6">Juegos relacionados</h2>
    <div class="inline-grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 justify-center">
      @foreach($relacionados as $rel)
        <a href="{{ route('catalogo.show', $rel) }}"
           class="w-64 bg-white/10 backdrop-blur-lg border border-white/20
                  rounded-2xl shadow-xl overflow-hidden hover:scale-105 transform transition-transform duration-200">
          @if($rel->imagen)
            <img src="{{ asset($rel->imagen) }}"
                 alt="{{ $rel->titulo }}"
                 class="w-full h-32 object-cover">
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

{{-- Aquí “pushamos” un JS que se ejecutará sólo en esta vista --}}
@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const btnAddCart = document.getElementById('btnAddCart');
    if (btnAddCart) {
      btnAddCart.addEventListener('click', function(e) {
        e.preventDefault(); // evitamos que el form se envíe inmediatamente
        // 1) Podemos mostrar una alerta antes de enviar el form:
        if (confirm("¿Estás seguro de que quieres añadir \"{{ $videojuego->titulo }}\" al carrito?")) {
          // Si confirma, enviamos el formulario:
          this.closest('form').submit();
        }
        // Si cancela, no hacemos nada y evitamos el envío.
      });
    }

    const btnBuyNow = document.getElementById('btnBuyNow');
    if (btnBuyNow) {
      btnBuyNow.addEventListener('click', function(e) {
        e.preventDefault();
        alert("Redirigiendo a la pasarela de pago para \"{{ $videojuego->titulo }}\"...");
        this.closest('form').submit();
      });
    }
  });
</script>
@endpush
