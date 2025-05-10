@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h1>Key #{{ $key->id }} de {{ $videojuego->titulo }}</h1>

  <p><strong>Código:</strong> {{ $key->key_code }}</p>
  <p><strong>Vendida:</strong> {{ $key->sold ? 'Sí' : 'No' }}</p>
  <p><strong>Creada:</strong> {{ $key->created_at->format('Y-m-d H:i') }}</p>
  <p><strong>Actualizada:</strong> {{ $key->updated_at->format('Y-m-d H:i') }}</p>

  <a href="{{ route('admin.videojuegos.keys.index', $videojuego) }}" class="btn btn-secondary">Volver</a>
  <a href="{{ route('admin.keys.edit', $key) }}" class="btn btn-warning">Editar</a>
</div>
@endsection
