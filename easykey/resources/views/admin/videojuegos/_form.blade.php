{{-- fields --}}
<div class="mb-3">
  <label>Título</label>
  <input name="titulo" value="{{ old('titulo', $videojuego->titulo ?? '') }}" class="form-control">
  @error('titulo')<small class="text-danger">{{ $message }}</small>@enderror
</div>
<div class="mb-3">
  <label>Descripción</label>
  <textarea name="descripcion" class="form-control">{{ old('descripcion', $videojuego->descripcion ?? '') }}</textarea>
  @error('descripcion')<small class="text-danger">{{ $message }}</small>@enderror
</div>
<div class="row">
  <div class="col-md-6 mb-3">
    <label>Plataforma</label>
    <input name="plataforma" value="{{ old('plataforma', $videojuego->plataforma ?? '') }}" class="form-control">
    @error('plataforma')<small class="text-danger">{{ $message }}</small>@enderror
  </div>
  <div class="col-md-6 mb-3">
    <label>Precio (€)</label>
    <input name="precio" type="number" step="0.01" value="{{ old('precio', $videojuego->precio ?? '') }}" class="form-control">
    @error('precio')<small class="text-danger">{{ $message }}</small>@enderror
  </div>
</div>
<div class="mb-3">
  <label>URL de imagen</label>
  <input name="imagen" value="{{ old('imagen', $videojuego->imagen ?? '') }}" class="form-control">
  @error('imagen')<small class="text-danger">{{ $message }}</small>@enderror
</div>
