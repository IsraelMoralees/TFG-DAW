@extends('layouts.app')

@section('content')
<div class="container">
  <h1 class="mb-4">Listado de Videojuegos</h1>
  <a href="{{ route('admin.videojuegos.create') }}" class="btn btn-primary mb-3">+ Nuevo Juego</a>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <table class="table table-striped">
    <thead><tr>
      <th>ID</th><th>Título</th><th>Plataforma</th><th>Precio</th><th>Creado</th><th>Acciones</th>
    </tr></thead>
    <tbody>
      @forelse($videojuegos as $j)
      <tr>
        <td>{{ $j->id }}</td>
        <td>{{ $j->titulo }}</td>
        <td>{{ $j->plataforma }}</td>
        <td>€{{ number_format($j->precio,2) }}</td>
        <td>{{ $j->created_at->format('d/m/Y') }}</td>
        <td>
          <a href="{{ route('admin.videojuegos.show', $j) }}" class="btn btn-info btn-sm">Ver</a>
          <a href="{{ route('admin.videojuegos.edit', $j) }}" class="btn btn-warning btn-sm">Editar</a>
          <form action="{{ route('admin.videojuegos.destroy', $j) }}" method="POST" class="d-inline">
            @csrf @method('DELETE')
            <button class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar?')">Borrar</button>
          </form>
        </td>
      </tr>
      @empty
      <tr><td colspan="6" class="text-center">No hay videojuegos.</td></tr>
      @endforelse
    </tbody>
  </table>

  {{ $videojuegos->links() }}
</div>
@endsection
