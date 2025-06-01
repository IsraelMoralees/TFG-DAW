@extends('layouts.app')
@section('content')
<div class="container mx-auto px-4 py-4">
  <h1 class="text-white text-3xl font-bold mb-4">Listado de Videojuegos</h1>

  @if(session('success'))
    <div class="bg-green-600 text-white px-4 py-2 rounded-md mb-4">
      {{ session('success') }}
    </div>
  @endif

  <a href="{{ route('admin.videojuegos.create') }}" 
     class="inline-block mb-6 bg-gradient-to-r from-indigo-500 to-purple-500 
            text-white font-semibold px-4 py-2 rounded-2xl shadow-lg 
            hover:from-purple-500 hover:to-pink-500 transform transition duration-200">
    + Nuevo Juego
  </a>

  @if($videojuegos->isEmpty())
    <p class="text-gray-300">No hay videojuegos.</p>
  @else
    <div class="overflow-x-auto bg-white/10 backdrop-blur-lg border border-white/20 
                rounded-2xl shadow-xl">
      <table class="min-w-full">
        <thead>
          <tr class="bg-white/20">
            <th class="px-4 py-3 text-left text-gray-300 uppercase tracking-wider">ID</th>
            <th class="px-4 py-3 text-left text-gray-300 uppercase tracking-wider">Título</th>
            <th class="px-4 py-3 text-left text-gray-300 uppercase tracking-wider">Plataforma</th>
            <th class="px-4 py-3 text-left text-gray-300 uppercase tracking-wider">Precio</th>
            <th class="px-4 py-3 text-left text-gray-300 uppercase tracking-wider">Creado</th>
            <th class="px-4 py-3 text-left text-gray-300 uppercase tracking-wider">Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($videojuegos as $j)
            <tr class="hover:bg-white/20 border-b border-gray-700">
              <td class="px-4 py-3 text-white">{{ $j->id }}</td>
              <td class="px-4 py-3 text-white">{{ $j->titulo }}</td>
              <td class="px-4 py-3 text-white">{{ $j->plataforma }}</td>
              <td class="px-4 py-3 text-white">€{{ number_format($j->precio, 2) }}</td>
              <td class="px-4 py-3 text-white">{{ $j->created_at->format('Y-m-d') }}</td>
              <td class="px-4 py-3">
                <div class="flex space-x-2">
                  <a href="{{ route('admin.videojuegos.show', $j) }}"
                     class="inline-block bg-gradient-to-r from-indigo-500 to-purple-500 
                            text-white text-sm font-medium px-3 py-1 rounded-lg shadow-sm 
                            hover:from-purple-500 hover:to-pink-500 transform transition duration-200">
                    Ver
                  </a>
                  <a href="{{ route('admin.videojuegos.edit', $j) }}"
                     class="inline-block bg-gradient-to-r from-purple-500 to-pink-500 
                            text-white text-sm font-medium px-3 py-1 rounded-lg shadow-sm 
                            hover:from-pink-500 hover:to-red-500 transform transition duration-200">
                    Editar
                  </a>
                  <form action="{{ route('admin.videojuegos.destroy', $j) }}" method="POST" 
                        class="inline-block" 
                        onsubmit="return confirm('¿Borrar?');">
                    @csrf 
                    @method('DELETE')
                    <button type="submit"
                            class="bg-gradient-to-r from-pink-500 to-red-500 
                                   text-white text-sm font-medium px-3 py-1 rounded-lg 
                                   shadow-sm hover:from-red-500 hover:to-pink-500 
                                   transform transition duration-200">
                      Borrar
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    <div class="mt-6">
      {{ $videojuegos->links() }}
    </div>
  @endif
</div>
@endsection
