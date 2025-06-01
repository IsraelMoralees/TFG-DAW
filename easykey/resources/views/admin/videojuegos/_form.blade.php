{{-- resources/views/admin/videojuegos/_form.blade.php --}}

<form 
    action="{{ isset($videojuego)
        ? route('admin.videojuegos.update', $videojuego)
        : route('admin.videojuegos.store') }}"
    method="POST"
    enctype="multipart/form-data"
    class="space-y-6"
>
    @csrf
    @if(isset($videojuego))
        @method('PUT')
    @endif

    {{-- Título --}}
    <div class="flex flex-col">
      <label class="text-gray-300 mb-1">Título</label>
      <input 
        name="titulo"
        value="{{ old('titulo', $videojuego->titulo ?? '') }}"
        class="w-full bg-white/10 border border-white/20 rounded-2xl text-white px-3 py-2 
               focus:outline-none focus:ring-2 focus:ring-indigo-500"
        placeholder="Introduce el título"
      >
      @error('titulo')
        <small class="text-red-400 mt-1">{{ $message }}</small>
      @enderror
    </div>

    {{-- Descripción --}}
    <div class="flex flex-col">
      <label class="text-gray-300 mb-1">Descripción</label>
      <textarea
        name="descripcion"
        rows="4"
        class="w-full bg-white/10 border border-white/20 rounded-2xl text-white px-3 py-2 
               focus:outline-none focus:ring-2 focus:ring-indigo-500"
        placeholder="Escribe una descripción"
      >{{ old('descripcion', $videojuego->descripcion ?? '') }}</textarea>
      @error('descripcion')
        <small class="text-red-400 mt-1">{{ $message }}</small>
      @enderror
    </div>

    {{-- Plataforma y Precio --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      {{-- Plataforma --}}
      <div class="flex flex-col">
        <label class="text-gray-300 mb-1">Plataforma</label>
        <input 
          name="plataforma"
          value="{{ old('plataforma', $videojuego->plataforma ?? '') }}"
          class="w-full bg-white/10 border border-white/20 rounded-2xl text-white px-3 py-2 
                 focus:outline-none focus:ring-2 focus:ring-indigo-500"
          placeholder="Ej: PC, PS5, Xbox"
        >
        @error('plataforma')
          <small class="text-red-400 mt-1">{{ $message }}</small>
        @enderror
      </div>

      {{-- Precio --}}
      <div class="flex flex-col">
        <label class="text-gray-300 mb-1">Precio (€)</label>
        <input 
          name="precio"
          type="number"
          step="0.01"
          value="{{ old('precio', $videojuego->precio ?? '') }}"
          class="w-full bg-white/10 border border-white/20 rounded-2xl text-white px-3 py-2 
                 focus:outline-none focus:ring-2 focus:ring-indigo-500"
          placeholder="0.00"
        >
        @error('precio')
          <small class="text-red-400 mt-1">{{ $message }}</small>
        @enderror
      </div>
    </div>

    {{-- Subir imagen --}}
    <div class="flex flex-col">
      <label class="text-gray-300 mb-1">Subir imagen</label>
      <input 
        name="imagen_file"
        type="file"
        accept="image/*"
        class="text-gray-300 bg-white/10 border border-white/20 rounded-2xl px-3 py-2 
               focus:outline-none focus:ring-2 focus:ring-indigo-500"
      >
      @error('imagen_file')
        <small class="text-red-400 mt-1">{{ $message }}</small>
      @enderror
    </div>

    {{-- Botones --}}
    <div class="flex flex-wrap gap-4 mt-4">
      <button type="submit"
              class="bg-gradient-to-r from-indigo-500 to-purple-500 
                     text-white font-semibold px-5 py-2 rounded-2xl shadow-lg 
                     hover:from-purple-500 hover:to-pink-500 transform transition duration-200">
        {{ isset($videojuego) ? 'Actualizar' : 'Crear' }}
      </button>
      <a href="{{ route('admin.videojuegos.index') }}"
         class="bg-gradient-to-r from-gray-600 to-gray-700 
                text-white font-semibold px-5 py-2 rounded-2xl shadow-lg 
                hover:from-gray-500 hover:to-gray-600 transform transition duration-200">
        Cancelar
      </a>
    </div>
</form>
