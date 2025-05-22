{{-- resources/views/admin/videojuegos/create.blade.php --}}
@extends('layouts.app')

@section('content')
  <h1>Nuevo Videojuego</h1>

  <form 
    method="POST" 
    action="{{ route('admin.videojuegos.store') }}" 
    enctype="multipart/form-data"
  >
    @csrf

    @include('admin.videojuegos._form')

  </form>
@endsection
