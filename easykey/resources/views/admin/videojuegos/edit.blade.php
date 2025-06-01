{{-- resources/views/admin/videojuegos/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-4">
  <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl shadow-xl p-6">
    <h1 class="text-white text-3xl font-bold mb-6">Editar Videojuego</h1>

    <form 
      method="POST" 
      action="{{ route('admin.videojuegos.update', $videojuego) }}" 
      enctype="multipart/form-data"
      class="space-y-4"
    >
      @csrf
      @method('PUT')

      @include('admin.videojuegos._form')
    </form>
  </div>
</div>
@endsection
