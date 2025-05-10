@extends('layouts.app')
@section('content')
<div class="container py-4">
  <h1>Nuevo Videojuego</h1>
  <form action="{{ route('admin.videojuegos.store') }}" method="POST">
    @csrf
    @include('admin.videojuegos._form')
    <button class="btn btn-success">Guardar</button>
    <a href="{{ route('admin.videojuegos.index') }}" class="btn btn-secondary">Cancelar</a>
  </form>
</div>
@endsection
