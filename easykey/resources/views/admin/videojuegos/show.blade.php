@extends('layouts.app')
@section('content')
<div class="container py-4">
  <h1>{{ $videojuego->titulo }}</h1>
  <img src="{{ $videojuego->imagen }}" class="img-fluid mb-4">
  <p><strong>Descripción:</strong> {{ $videojuego->descripcion }}</p>
  <p><strong>Plataforma:</strong> {{ $videojuego->plataforma }}</p>
  <p><strong>Precio:</strong> €{{ number_format($videojuego->precio,2) }}</p>
  <a href="{{ route('admin.videojuegos.index') }}" class="btn btn-secondary">Volver</a>
  <a href="{{ route('admin.videojuegos.edit', $videojuego) }}" class="btn btn-warning">Editar</a>
</div>
@endsection
