@extends('layouts.app')
@section('content')
<div class="container py-4">
  <h1>Listado de Videojuegos</h1>
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  <a href="{{ route('admin.videojuegos.create') }}" class="btn btn-primary mb-3">+ Nuevo Juego</a>
  @if($videojuegos->isEmpty())
    <p>No hay videojuegos.</p>
  @else
    <table class="table table-striped">
      <thead><tr>
        <th>ID</th><th>Título</th><th>Plataforma</th><th>Precio</th><th>Creado</th><th>Acciones</th>
      </tr></thead>
      <tbody>
        @foreach($videojuegos as $j)
        <tr>
          <td>{{ $j->id }}</td>
          <td>{{ $j->titulo }}</td>
          <td>{{ $j->plataforma }}</td>
          <td>€{{ number_format($j->precio,2) }}</td>
          <td>{{ $j->created_at->format('Y-m-d') }}</td>
          <td>
            <a class="btn btn-sm btn-info"  href="{{ route('admin.videojuegos.show', $j) }}">Ver</a>
            <a class="btn btn-sm btn-warning" href="{{ route('admin.videojuegos.edit', $j) }}">Editar</a>
            <form action="{{ route('admin.videojuegos.destroy', $j) }}" method="POST" style="display:inline" onsubmit="return confirm('¿Borrar?');">
              @csrf @method('DELETE')
              <button class="btn btn-sm btn-danger">Borrar</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{ $videojuegos->links() }}
  @endif
</div>
@endsection
