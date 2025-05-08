@extends('layouts.app')

@section('content')
<div class="container">
  <h1>{{ $videojuego->titulo }}</h1>
  <img src="{{ $videojuego->imagen }}" alt="{{ $videojuego->titulo }}" class="img-fluid mb-4">
  <p>{{ $videojuego->descripcion }}</p>
  <p><strong>Plataforma:</strong> {{ $videojuego->plataforma }}</p>
  <p><strong>Precio:</strong> €{{ number_format($videojuego->precio,2) }}</p>
  <a href="{{ route('catalogo') }}" class="btn btn-secondary mt-3">← Volver al catálogo</a>
</div>
@endsection

