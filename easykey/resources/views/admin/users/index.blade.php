@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Usuarios</h1>
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  <table class="table">
    <thead>
      <tr><th>ID</th><th>Nombre</th><th>Email</th><th>Rol</th><th>Acciones</th></tr>
    </thead>
    <tbody>
      @foreach($users as $u)
      <tr>
        <td>{{ $u->id }}</td>
        <td>{{ $u->name }}</td>
        <td>{{ $u->email }}</td>
        <td>{{ $u->role }}</td>
        <td>
          <a href="{{ route('admin.users.edit', $u) }}" class="btn btn-sm btn-primary">Editar</a>
          <form action="{{ route('admin.users.destroy', $u) }}" method="POST" class="d-inline">
            @csrf @method('DELETE')
            <button class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro?')">Borrar</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{ $users->links() }}
</div>
@endsection
