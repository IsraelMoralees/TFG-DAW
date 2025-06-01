@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-4">
  <!-- Título de la página -->
  <h1 class="text-white text-3xl font-bold mb-6">Claves de: {{ $videojuego->titulo }}</h1>

  <!-- Mensaje de éxito -->
  @if(session('success'))
    <div class="bg-green-600 text-white px-4 py-2 rounded-md mb-4">
      {{ session('success') }}
    </div>
  @endif

  <!-- Botón para crear nueva key -->
  <a href="{{ route('admin.videojuegos.keys.create', $videojuego) }}"
     class="inline-block mb-6 bg-gradient-to-r from-indigo-500 to-purple-500 
            text-white font-semibold px-4 py-2 rounded-2xl shadow-lg 
            hover:from-purple-500 hover:to-pink-500 transform transition duration-200">
    + Nueva Key
  </a>

  <!-- Tabla de claves -->
  @if($keys->isEmpty())
    <p class="text-gray-300">No hay claves registradas.</p>
  @else
    <div class="overflow-x-auto bg-white/10 backdrop-blur-lg border border-white/20 
                rounded-2xl shadow-xl">
      <table class="min-w-full">
        <thead>
          <tr class="bg-white/20">
            <th class="px-4 py-3 text-left text-gray-300 uppercase tracking-wider">ID</th>
            <th class="px-4 py-3 text-left text-gray-300 uppercase tracking-wider">Código</th>
            <th class="px-4 py-3 text-left text-gray-300 uppercase tracking-wider">Vendida</th>
            <th class="px-4 py-3 text-left text-gray-300 uppercase tracking-wider">Creada</th>
            <th class="px-4 py-3 text-left text-gray-300 uppercase tracking-wider">Acciones</th>
          </tr>
        </thead>
        <tbody>
          @foreach($keys as $key)
            <tr class="hover:bg-white/20 border-b border-gray-700">
              <td class="px-4 py-3 text-white">{{ $key->id }}</td>
              <td class="px-4 py-3 text-white">{{ $key->key_code }}</td>
              <td class="px-4 py-3">
                @if($key->sold)
                  <span class="inline-block bg-green-600 text-white text-xs font-semibold 
                               px-2 py-1 rounded-full">
                    Sí
                  </span>
                @else
                  <span class="inline-block bg-gray-500 text-white text-xs font-semibold 
                               px-2 py-1 rounded-full">
                    No
                  </span>
                @endif
              </td>
              <td class="px-4 py-3 text-white">
                {{ $key->created_at->format('Y-m-d') }}
              </td>
              <td class="px-4 py-3">
                <div class="flex space-x-2">
                  <a href="{{ route('admin.keys.show', $key) }}"
                     class="inline-block bg-gradient-to-r from-indigo-500 to-purple-500 
                            text-white text-sm font-medium px-3 py-1 rounded-lg shadow-sm 
                            hover:from-purple-500 hover:to-pink-500 transform transition duration-200">
                    Ver
                  </a>
                  <a href="{{ route('admin.keys.edit', $key) }}"
                     class="inline-block bg-gradient-to-r from-purple-500 to-pink-500 
                            text-white text-sm font-medium px-3 py-1 rounded-lg shadow-sm 
                            hover:from-pink-500 hover:to-red-500 transform transition duration-200">
                    Editar
                  </a>
                  <form action="{{ route('admin.keys.destroy', $key) }}" method="POST" 
                        class="inline-block" 
                        onsubmit="return confirm('¿Eliminar clave?');">
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

    <!-- Paginación -->
    <div class="mt-6">
      {{ $keys->links() }}
    </div>
  @endif

  <!-- Botón para volver al listado de videojuegos -->
  <a href="{{ route('admin.videojuegos.index') }}" 
     class="inline-block mt-6 bg-gradient-to-r from-gray-600 to-gray-700 
            text-white font-semibold px-4 py-2 rounded-2xl shadow-lg 
            hover:from-gray-500 hover:to-gray-600 transform transition duration-200">
    ← Volver a Videojuegos
  </a>
</div>
@endsection
