  @extends('layouts.app')
  @section('content')
  <div class="container mx-auto px-4 py-4">
    <div class="flex flex-col md:flex-row bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl shadow-xl p-6">
      <!-- Información del videojuego -->
      <div class="md:w-2/3 md:pl-6">
        <h1 class="text-white text-4xl font-bold mb-4">{{ $videojuego->titulo }}</h1>
        <p class="text-gray-300 mb-2">
          <strong>Descripción:</strong> {{ $videojuego->descripcion }}
        </p>
        <p class="text-gray-300 mb-2">
          <strong>Plataforma:</strong> {{ $videojuego->plataforma }}
        </p>
        <p class="text-gray-300 mb-4">
          <strong>Precio:</strong> €{{ number_format($videojuego->precio, 2) }}
        </p>

        <!-- Botones de acción -->
        <div class="flex space-x-4">
          <a href="{{ route('admin.videojuegos.index') }}" 
            class="bg-gradient-to-r from-indigo-500 to-purple-500 
                    text-white font-semibold px-4 py-2 rounded-2xl shadow-lg 
                    hover:from-purple-500 hover:to-pink-500 transform transition duration-200">
            Volver
          </a>
          <a href="{{ route('admin.videojuegos.edit', $videojuego) }}" 
            class="bg-gradient-to-r from-purple-500 to-pink-500 
                    text-white font-semibold px-4 py-2 rounded-2xl shadow-lg 
                    hover:from-pink-500 hover:to-red-500 transform transition duration-200">
            Editar
          </a>
          <a href="{{ route('admin.videojuegos.keys.index', $videojuego) }}" 
            class="bg-gradient-to-r from-green-500 to-teal-500 
                    text-white font-semibold px-4 py-2 rounded-2xl shadow-lg 
                    hover:from-teal-500 hover:to-green-500 transform transition duration-200">
            Añadir Keys
          </a>
        </div>
      </div>
    </div>
  </div>
  @endsection
