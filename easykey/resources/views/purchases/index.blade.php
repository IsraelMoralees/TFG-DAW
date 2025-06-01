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