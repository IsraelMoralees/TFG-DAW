@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h1>Nueva Key para: {{ $videojuego->titulo }}</h1>

  <form action="{{ route('admin.videojuegos.keys.store', $videojuego) }}" method="POST">
    @csrf
    @include('admin.keys._form')
    <button class="btn btn-success">Guardar</button>
    <a href="{{ route('admin.videojuegos.keys.index', $videojuego) }}" class="btn btn-secondary">Cancelar</a>
  </form>
</div>
@endsection
