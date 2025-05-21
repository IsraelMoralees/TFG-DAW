{{-- resources/views/admin/videojuegos/_form.blade.php --}}

<form 
    action="{{ isset($videojuego)
        ? route('admin.videojuegos.update', $videojuego)
        : route('admin.videojuegos.store') }}"
    method="POST"
    enctype="multipart/form-data" {{-- ¡MUY IMPORTANTE! --}}
>
    @csrf
    @if(isset($videojuego))
        @method('PUT')
    @endif

    {{-- Título --}}
    <div class="mb-3">
      <label class="form-label">Título</label>
      <input 
        name="titulo"
        value="{{ old('titulo', $videojuego->titulo ?? '') }}"
        class="form-control"
      >
      @error('titulo')<small class="text-danger">{{ $message }}</small>@enderror
    </div>

    {{-- Descripción --}}
    <div class="mb-3">
      <label class="form-label">Descripción</label>
      <textarea
        name="descripcion"
        class="form-control"
      >{{ old('descripcion', $videojuego->descripcion ?? '') }}</textarea>
      @error('descripcion')<small class="text-danger">{{ $message }}</small>@enderror
    </div>

    <div class="row">
      <div class="col-md-6 mb-3">
        <label class="form-label">Plataforma</label>
        <input 
          name="plataforma"
          value="{{ old('plataforma', $videojuego->plataforma ?? '') }}"
          class="form-control"
        >
        @error('plataforma')<small class="text-danger">{{ $message }}</small>@enderror
      </div>
      <div class="col-md-6 mb-3">
        <label class="form-label">Precio (€)</label>
        <input 
          name="precio"
          type="number"
          step="0.01"
          value="{{ old('precio', $videojuego->precio ?? '') }}"
          class="form-control"
        >
        @error('precio')<small class="text-danger">{{ $message }}</small>@enderror
      </div>
    </div>

    {{-- Nuevo campo: subir fichero --}}
    <div class="mb-3">
      <label class="form-label">Subir imagen</label>
      <input 
        name="imagen_file"
        type="file"
        accept="image/*"
        class="form-control"
      >
      @error('imagen_file')<small class="text-danger">{{ $message }}</small>@enderror
    </div>

    {{-- Botones --}}
    <div class="d-flex gap-2">
      <button type="submit" class="btn btn-primary">
        {{ isset($videojuego) ? 'Actualizar' : 'Crear' }}
      </button>
      <a href="{{ route('admin.videojuegos.index') }}" class="btn btn-secondary">
        Cancelar
      </a>
    </div>
</form>
