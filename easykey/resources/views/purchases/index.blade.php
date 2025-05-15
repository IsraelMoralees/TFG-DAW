{{-- resources/views/purchases/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Mis Compras</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @forelse($purchases as $purchase)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $purchase->videojuego->titulo }}</h5>
                <p>Clave: <code>{{ $purchase->key->key_code }}</code></p>
                <p>Fecha: {{ $purchase->purchased_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>
    @empty
        <p>No has realizado ninguna compra todavía.</p>
    @endforelse
</div>
@endsection
