{{-- resources/views/cart/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-8">
  <h1 class="text-2xl font-bold text-white mb-6">Tu carrito</h1>

  @if($items->isEmpty())
  <p class="text-gray-300">No hay nada en el carrito.</p>
  @else
  <table class="w-full text-left bg-gray-800 rounded-lg overflow-hidden">
    <thead class="bg-gray-700 text-gray-200">
      <tr>
        <th class="p-2">Juego</th>
        <th class="p-2">Cantidad</th>
        <th class="p-2">Precio unidad</th>
        <th class="p-2">Total</th>
        <th class="p-2"></th>
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
      <tr class="border-b border-gray-700">
        <td class="p-2">{{ $juego->titulo }}</td>
        <td class="p-2">{{ $qty }}</td>
        <td class="p-2">€{{ number_format($juego->precio, 2) }}</td>
        <td class="p-2">€{{ number_format($subtotal, 2) }}</td>
        <td class="p-2">
          <form action="{{ route('cart.remove', $juego) }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="text-red-500 hover:underline">Eliminar</button>
          </form>
        </td>
      </tr>
      @endforeach
      <tr>
        <td colspan="3" class="p-2 font-bold text-right">Total:</td>
        <td class="p-2 font-bold">€{{ number_format($grand, 2) }}</td>
        <td></td>
      </tr>
    </tbody>
  </table>

  {{-- Botón checkout general --}}
  <div class="mt-4 text-right">
    <form action="{{ route('cart.checkout') }}" method="POST">
  @csrf
  <button class="bg-green-600 hover:bg-green-700 text-white py-2 px-6 rounded">
    Pagar todo
  </button>
</form>

  </div>
  @endif
</div>
@endsection