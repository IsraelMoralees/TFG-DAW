@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-4">
  <!-- Título de la página -->
  <h1 class="text-white text-3xl font-bold mb-6">
    Editar Usuario #{{ $user->id }}
  </h1>

  <!-- Formulario con estilo -->
  <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl shadow-xl p-6">
    <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-6">
      @csrf 
      @method('PUT')

      <!-- Nombre -->
      <div class="flex flex-col">
        <label class="text-gray-300 mb-1">Nombre</label>
        <input 
          type="text" 
          name="name" 
          value="{{ old('name', $user->name) }}" 
          class="w-full bg-white/10 border border-white/20 rounded-2xl text-white px-3 py-2 
                 focus:outline-none focus:ring-2 focus:ring-indigo-500" 
          required
          placeholder="Introduce el nombre"
        >
        @error('name')
          <small class="text-red-400 mt-1">{{ $message }}</small>
        @enderror
      </div>

      <!-- Email -->
      <div class="flex flex-col">
        <label class="text-gray-300 mb-1">Email</label>
        <input 
          type="email" 
          name="email" 
          value="{{ old('email', $user->email) }}" 
          class="w-full bg-white/10 border border-white/20 rounded-2xl text-white px-3 py-2 
                 focus:outline-none focus:ring-2 focus:ring-indigo-500" 
          required
          placeholder="Introduce el email"
        >
        @error('email')
          <small class="text-red-400 mt-1">{{ $message }}</small>
        @enderror
      </div>

      <!-- Rol -->
      <div class="flex flex-col">
        <label class="text-gray-300 mb-1">Rol</label>
        <select 
          name="role" 
          class="w-full bg-white/10 border border-white/20 rounded-2xl text-white px-3 py-2 
                 focus:outline-none focus:ring-2 focus:ring-indigo-500" 
          required
        >
          <option value="user"  {{ old('role', $user->role) === 'user'  ? 'selected' : '' }}>User</option>
          <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>Admin</option>
        </select>
        @error('role')
          <small class="text-red-400 mt-1">{{ $message }}</small>
        @enderror
      </div>

      <!-- Botones de acción -->
      <div class="flex space-x-4">
        <button 
          type="submit"
          class="bg-gradient-to-r from-indigo-500 to-purple-500 
                 text-white font-semibold px-4 py-2 rounded-2xl shadow-lg 
                 hover:from-purple-500 hover:to-pink-500 transform transition duration-200"
        >
          Guardar cambios
        </button>
        <a 
          href="{{ route('admin.users.index') }}" 
          class="bg-gradient-to-r from-gray-600 to-gray-700 
                 text-white font-semibold px-4 py-2 rounded-2xl shadow-lg 
                 hover:from-gray-500 hover:to-gray-600 transform transition duration-200"
        >
          Cancelar
        </a>
      </div>
    </form>
  </div>
</div>
@endsection
