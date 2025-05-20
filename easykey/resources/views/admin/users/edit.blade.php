@extends('layouts.app')

@section('content')
<div class="container">
  <h1>Editar Usuario #{{ $user->id }}</h1>
  <form action="{{ route('admin.users.update', $user) }}" method="POST">
    @csrf @method('PUT')

    <div class="mb-3">
      <label class="form-label">Nombre</label>
      <input type="text" name="name" value="{{ old('name',$user->name) }}" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" value="{{ old('email',$user->email) }}" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Rol</label>
      <select name="role" class="form-select" required>
        <option value="user"  {{ $user->role==='user'  ? 'selected':'' }}>User</option>
        <option value="admin" {{ $user->role==='admin' ? 'selected':'' }}>Admin</option>
      </select>
    </div>

    <button class="btn btn-primary">Guardar cambios</button>
  </form>
</div>
@endsection
