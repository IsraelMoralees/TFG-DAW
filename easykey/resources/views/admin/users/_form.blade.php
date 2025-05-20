<div class="mb-3">
    <label for="name" class="form-label">Nombre</label>
    <input type="text"
           name="name"
           id="name"
           class="form-control @error('name') is-invalid @enderror"
           value="{{ old('name', $user->name) }}">
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email"
           name="email"
           id="email"
           class="form-control @error('email') is-invalid @enderror"
           value="{{ old('email', $user->email) }}">
    @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="role" class="form-label">Rol</label>
    <select name="role"
            id="role"
            class="form-select @error('role') is-invalid @enderror">
        <option value="user"  {{ old('role', $user->role)=='user'  ? 'selected' : '' }}>Usuario</option>
        <option value="admin" {{ old('role', $user->role)=='admin' ? 'selected' : '' }}>Administrador</option>
    </select>
    @error('role')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
