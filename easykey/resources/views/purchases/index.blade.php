@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8 px-4">
    <h1 class="text-3xl font-bold text-white mb-6">Mis Compras</h1>

    @if(session('success'))
    <div class="bg-green-500 bg-opacity-60 text-white px-4 py-3 rounded-lg mb-6">
        {{ session('success') }}
    </div>
    @endif

    @if($purchases->count())
    <div class="overflow-x-auto bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl p-4 shadow-lg">
        <table class="w-full table-auto">
            <thead>
                <tr class="text-left text-white">
                    <th class="px-4 py-2">Juego</th>
                    <th class="px-4 py-2">Clave</th>
                    <th class="px-4 py-2">Fecha</th>
                    <th class="px-4 py-2">Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($purchases as $purchase)
                <tr class="border-t border-white/20 hover:bg-white/20 transition-colors">
                    <td class="px-4 py-3 text-gray-100 font-medium">{{ $purchase->videojuego->titulo }}</td>
                    <td class="px-4 py-3 text-gray-300">
                        <code class="bg-gray-800 px-2 py-1 rounded">{{ $purchase->key->key_code }}</code>
                    </td>
                    <td class="px-4 py-3 text-gray-300">{{ $purchase->purchased_at->format('d/m/Y H:i') }}</td>
                    <td class="px-4 py-3">
                        <a href="{{ route('catalogo.show', $purchase->videojuego) }}" class="inline-block bg-gradient-to-r from-indigo-500 to-purple-500 text-white px-4 py-2 rounded-lg shadow-md hover:from-purple-500 hover:to-pink-500 transform hover:scale-105 transition-transform">
                            Ver detalles
                        </a>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <p class="text-gray-300">No has realizado ninguna compra todavía.</p>
    @endif
</div>
@endsection