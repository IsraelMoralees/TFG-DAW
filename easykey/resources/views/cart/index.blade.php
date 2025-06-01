{{-- resources/views/cart/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Tu Carrito')

@section('content')
<div class="max-w-3xl mx-auto py-8">
  <div class="p-6 bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl shadow-xl">
    <h1 class="text-2xl font-bold text-white mb-6">Tu carrito</h1>

    @if($items->isEmpty())
      <p class="text-gray-300 mb-6">No hay nada en el carrito.</p>
      <a href="{{ route('catalogo') }}" class="inline-block bg-gradient-to-r from-purple-500 to-pink-500 hover:from-pink-500 hover:to-purple-500 text-white font-semibold py-2 px-6 rounded-2xl shadow-lg transition transform hover:scale-105">
        Ver catálogo
      </a>
    @else
      <table class="w-full text-left text-gray-200 border-separate border-spacing-0 mb-6">
        <thead>
          <tr>
            <th class="p-4">Juego</th>
            <th class="p-4">Cantidad</th>
            <th class="p-4">Precio unidad</th>
            <th class="p-4">Total</th>
            <th class="p-4"></th>
          </tr>
        </thead>
        <tbody>
          @php $grand = 0; @endphp
          @foreach($items as $juego)
            @php
              $qty = $cart[$juego->id];
              $subtotal = $juego->precio * $qty;
              $grand += $subtotal;
            @endphp
            <tr class="border-b border-white/20 hover:bg-white/20 transition rounded-lg">
              <td class="p-4 text-white font-medium">{{ $juego->titulo }}</td>
              <td class="p-4">{{ $qty }}</td>
              <td class="p-4">€{{ number_format($juego->precio, 2) }}</td>
              <td class="p-4">€{{ number_format($subtotal, 2) }}</td>
              <td class="p-4">
                <form class="remove-form" data-titulo="{{ $juego->titulo }}" action="{{ route('cart.remove', $juego) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="remove-btn text-pink-400 hover:text-pink-300 font-semibold transition">
                    Eliminar
                  </button>
                </form>
              </td>
            </tr>
          @endforeach
          <tr>
            <td colspan="3" class="p-4 text-right font-bold text-white">Total:</td>
            <td class="p-4 font-bold text-white">€{{ number_format($grand, 2) }}</td>
            <td></td>
          </tr>
        </tbody>
      </table>

      <div class="flex justify-end items-center gap-4">
        <form action="{{ route('cart.checkout') }}" method="POST">
          @csrf
          <button class="bg-gradient-to-r from-indigo-500 to-purple-500 hover:from-purple-500 hover:to-pink-500 text-white font-semibold py-2 px-6 rounded-2xl shadow-lg transform transition duration-300 hover:scale-105">
            Pagar todo
          </button>
        </form>
        <a href="{{ route('catalogo') }}" class="bg-gradient-to-r from-purple-500 to-indigo-500 hover:from-indigo-500 hover:to-purple-500 text-white font-semibold py-2 px-6 rounded-2xl shadow-lg transform transition duration-300 hover:scale-105">
          Seguir comprando
        </a>
      </div>
    @endif
  </div>
</div>

@endsection

{{-- Push JS para confirmar antes de eliminar un juego --}}
@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Seleccionamos todos los formularios con clase .remove-form
    document.querySelectorAll('.remove-form').forEach(form => {
      const titulo = form.dataset.titulo; // el nombre del juego a eliminar
      form.addEventListener('submit', function(e) {
        if (! confirm(`¿Estás seguro de que quieres eliminar "${titulo}" del carrito?`)) {
          e.preventDefault();
        }
        // Si confirma, el form se envía normalmente y el juego se quita.
      });
    });
  });
</script>
@endpush
