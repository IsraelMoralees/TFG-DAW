@extends('layouts.app')
@section('content')
<div class="container py-4">
  <h1>Editar Videojuego</h1>
  <form action="{{ route('admin.videojuegos.update', $videojuego) }}" method="POST">
    @csrf @method('PUT')
    @include('admin.videojuegos._form')
    <button class="btn btn-primary">Actualizar</button>
    <a href="{{ route('admin.videojuegos.index') }}" class="btn btn-secondary">Cancelar</a>
  </form>
</div>
@endsection
