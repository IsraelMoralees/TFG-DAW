@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h1>Editar Key #{{ $key->id }} ({{ $videojuego->titulo }})</h1>

  <form action="{{ route('admin.keys.update', $key) }}" method="POST">
    @csrf @method('PUT')
    @include('admin.keys._form')
    <button class="btn btn-primary">Actualizar</button>
    <a href="{{ route('admin.videojuegos.keys.index', $videojuego) }}" class="btn btn-secondary">Cancelar</a>
  </form>
</div>
@endsection
