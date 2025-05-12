@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-3">{{ $videojuego->titulo }}</h1>
    <p>{{ $videojuego->descripcion }}</p>
    <p><strong>Plataforma:</strong> {{ $videojuego->plataforma }}</p>
    <p><strong>Precio:</strong> €{{ $videojuego->precio }}</p>

    @auth
    <form action="{{ route('purchase.checkout', $videojuego) }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success">
            Comprar ahora
        </button>
    </form>
    @else
    <a href="{{ route('login') }}" class="btn btn-primary">
        Inicia sesión para comprar
    </a>
    @endauth
</div>
@endsection