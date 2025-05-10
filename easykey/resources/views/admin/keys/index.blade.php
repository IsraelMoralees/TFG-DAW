@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h1>Claves de: {{ $videojuego->titulo }}</h1>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <a href="{{ route('admin.videojuegos.keys.create', $videojuego) }}"
     class="btn btn-primary mb-3">+ Nueva Key</a>

  @if($keys->isEmpty())
    <p>No hay claves registradas.</p>
  @else
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>ID</th><th>Código</th><th>Vendida</th><th>Creada</th><th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($keys as $key)
        <tr>
          <td>{{ $key->id }}</td>
          <td>{{ $key->key_code }}</td>
          <td>
            @if($key->sold)
              <span class="badge bg-success">Sí</span>
            @else
              <span class="badge bg-secondary">No</span>
            @endif
          </td>
          <td>{{ $key->created_at->format('Y-m-d') }}</td>
          <td>
            <a href="{{ route('admin.keys.show', $key) }}" class="btn btn-sm btn-info">Ver</a>
            <a href="{{ route('admin.keys.edit', $key) }}" class="btn btn-sm btn-warning">Editar</a>
            <form action="{{ route('admin.keys.destroy', $key) }}"
                  method="POST" style="display:inline" onsubmit="return confirm('¿Eliminar?');">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-danger">Borrar</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>

    {{ $keys->links() }}
  @endif

  <a href="{{ route('admin.videojuegos.index') }}" class="btn btn-secondary mt-3">
    ← Volver a Videojuegos
  </a>
</div>
@endsection
