<div class="flex flex-col mb-6">
  <label for="name" class="text-gray-300 mb-1">Nombre</label>
  <input
    type="text"
    name="name"
    id="name"
    value="{{ old('name', $user->name) }}"
    class="w-full bg-white/10 border border-white/20 rounded-2xl text-white px-3 py-2 
           focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('name') ring-2 ring-red-400 @enderror"
    placeholder="Introduce el nombre"
  >
  @error('name')
    <small class="text-red-400 mt-1">{{ $message }}</small>
  @enderror
</div>

<div class="flex flex-col mb-6">
  <label for="email" class="text-gray-300 mb-1">Email</label>
  <input
    type="email"
    name="email"
    id="email"
    value="{{ old('email', $user->email) }}"
    class="w-full bg-white/10 border border-white/20 rounded-2xl text-white px-3 py-2 
           focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('email') ring-2 ring-red-400 @enderror"
    placeholder="Introduce el email"
  >
  @error('email')
    <small class="text-red-400 mt-1">{{ $message }}</small>
  @enderror
</div>

<div class="flex flex-col mb-6">
  <label for="role" class="text-gray-300 mb-1">Rol</label>
  <select
    name="role"
    id="role"
    class="w-full bg-white/10 border border-white/20 rounded-2xl text-white px-3 py-2 
           focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('role') ring-2 ring-red-400 @enderror"
  >
    <option value="user"  {{ old('role', $user->role) == 'user'  ? 'selected' : '' }}>Usuario</option>
    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrador</option>
  </select>
  @error('role')
    <small class="text-red-400 mt-1">{{ $message }}</small>
  @enderror
</div>
