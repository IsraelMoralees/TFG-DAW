@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-4">
  <!-- Título de la página -->
  <h1 class="text-white text-3xl font-bold mb-6">Usuarios</h1>

  <!-- Mensaje de éxito -->
  @if(session('success'))
    <div class="bg-green-600 text-white px-4 py-2 rounded-md mb-4">
      {{ session('success') }}
    </div>
  @endif

  <!-- Tabla de usuarios -->
  <div class="overflow-x-auto bg-white/10 backdrop-blur-lg border border-white/20 
              rounded-2xl shadow-xl">
    <table class="min-w-full">
      <thead>
        <tr class="bg-white/20">
          <th class="px-4 py-3 text-left text-gray-300 uppercase tracking-wider">ID</th>
          <th class="px-4 py-3 text-left text-gray-300 uppercase tracking-wider">Nombre</th>
          <th class="px-4 py-3 text-left text-gray-300 uppercase tracking-wider">Email</th>
          <th class="px-4 py-3 text-left text-gray-300 uppercase tracking-wider">Rol</th>
          <th class="px-4 py-3 text-left text-gray-300 uppercase tracking-wider">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $u)
          <tr class="hover:bg-white/20 border-b border-gray-700">
            <td class="px-4 py-3 text-white">{{ $u->id }}</td>
            <td class="px-4 py-3 text-white">{{ $u->name }}</td>
            <td class="px-4 py-3 text-white">{{ $u->email }}</td>
            <td class="px-4 py-3 text-white">{{ $u->role }}</td>
            <td class="px-4 py-3">
              <div class="flex space-x-2">
                <a href="{{ route('admin.users.edit', $u) }}"
                   class="inline-block bg-gradient-to-r from-indigo-500 to-purple-500 
                          text-white text-sm font-medium px-3 py-1 rounded-lg shadow-sm 
                          hover:from-purple-500 hover:to-pink-500 transform transition duration-200">
                  Editar
                </a>
                <form action="{{ route('admin.users.destroy', $u) }}" method="POST" 
                      class="inline-block" onsubmit="return confirm('¿Seguro?');">
                  @csrf @method('DELETE')
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
    {{ $users->links() }}
  </div>
</div>
@endsection
