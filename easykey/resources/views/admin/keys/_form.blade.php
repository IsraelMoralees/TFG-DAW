{{-- resources/views/admin/keys/_form.blade.php --}}
<div class="mb-3">
  <label class="form-label">Código de la Key</label>
  <input name="key_code"
         value="{{ old('key_code', $key->key_code ?? '') }}"
         class="form-control">
  @error('key_code')<small class="text-danger">{{ $message }}</small>@enderror
</div>

<div class="form-check mb-3">
  <input type="hidden" name="sold" value="0">
  <input type="checkbox"
         name="sold"
         value="1"
         class="form-check-input"
         id="sold"
         {{ old('sold', $key->sold ?? false) ? 'checked' : '' }}>
  <label class="form-check-label" for="sold">Vendida</label>
</div>
