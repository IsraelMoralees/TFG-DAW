{{-- resources/views/admin/videojuegos/edit.blade.php --}}
@extends('layouts.app')

@section('content')
  <h1>Editar Videojuego</h1>

  <form 
    method="POST" 
    action="{{ route('admin.videojuegos.update', $videojuego) }}" 
    enctype="multipart/form-data"
  >
    @csrf
    @method('PUT')

    @include('admin.videojuegos._form')

  </form>
@endsection
