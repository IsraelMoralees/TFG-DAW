@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Catálogo de Videojuegos</h1>

    <div class="row">
        @foreach ($videojuegos as $juego)
        <div class="col-md-4 mb-3">
            <div class="card">
                <img src="{{ $juego->imagen }}" class="card-img-top" alt="{{ $juego->titulo }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $juego->titulo }}</h5>
                    <p class="card-text">{{ $juego->descripcion }}</p>
                    <p><strong>Plataforma:</strong> {{ $juego->plataforma }}</p>
                    <p><strong>Precio:</strong> €{{ $juego->precio }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
