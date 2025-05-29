{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-purple-600 to-indigo-800 flex items-center justify-center px-4 sm:px-6 lg:px-8">
  <div class="text-center">
    <h1 class="text-5xl font-extrabold text-white">
      Bienvenido a EasyKey
    </h1>
    <p class="mt-4 text-lg text-gray-200">
      Tu tienda de keys de videojuegos
    </p>
    <a href="{{ route('catalogo') }}"
       class="mt-6 inline-block bg-gradient-to-r from-indigo-500 to-purple-500 
              hover:from-indigo-600 hover:to-purple-600 text-white font-medium 
              py-3 px-6 rounded-lg transition duration-200">
      Ver catálogo
    </a>
  </div>
</div>
@endsection
