{{-- resources/views/admin/keys/_form.blade.php --}}
<div class="space-y-6">
  {{-- Código de la Key --}}
  <div class="flex flex-col">
    <label class="text-gray-300 mb-1">Código de la Key</label>
    <input
      name="key_code"
      value="{{ old('key_code', $key->key_code ?? '') }}"
      class="w-full bg-white/10 border border-white/20 rounded-2xl text-white px-3 py-2 
             focus:outline-none focus:ring-2 focus:ring-indigo-500"
      placeholder="Introduce el código"
    >
    @error('key_code')
      <small class="text-red-400 mt-1">{{ $message }}</small>
    @enderror
  </div>

  {{-- Vendida --}}
  <div class="flex items-center space-x-2">
    <input type="hidden" name="sold" value="0">
    <input
      type="checkbox"
      name="sold"
      value="1"
      id="sold"
      {{ old('sold', $key->sold ?? false) ? 'checked' : '' }}
      class="h-5 w-5 text-indigo-600 bg-white/10 border border-white/20 rounded focus:ring-2 focus:ring-indigo-500"
    >
    <label for="sold" class="text-gray-300 select-none">Vendida</label>
  </div>
</div>
