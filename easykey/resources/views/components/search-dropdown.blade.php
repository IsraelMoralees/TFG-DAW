@props(['action'])

<div x-data="{ open: false }" class="relative">
  <!-- botón que sólo muestra la lupa -->
  <button
    @click.prevent="open = !open"
    class="p-2 rounded hover:bg-gray-200 dark:hover:bg-gray-700"
    aria-label="Buscar"
  >
    <svg class="w-5 h-5 text-gray-600 dark:text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1116.65 7.65z" />
    </svg>
  </button>

  <!-- panel desplegable -->
  <div
    x-show="open"
    @click.away="open = false"
    class="absolute right-0 mt-2 w-64 bg-white dark:bg-gray-800 border dark:border-gray-700 rounded shadow-lg z-50 p-4"
    style="display: none;"
  >
    <form method="GET" action="{{ $action }}">
      <input
        type="text"
        name="q"
        value="{{ request('q') }}"
        placeholder="Buscar por título…"
        class="w-full px-3 py-2 border rounded focus:outline-none focus:ring"
      >

      <select name="plataforma" class="w-full mt-2 px-3 py-2 border rounded">
        <option value="">— Plataforma —</option>
        @foreach(\App\Models\Videojuego::distinct()->pluck('plataforma') as $plat)
          <option value="{{ $plat }}" @if(request('plataforma')===$plat) selected @endif>
            {{ $plat }}
          </option>
        @endforeach
      </select>

      <div class="flex space-x-2 mt-2">
        <input
          type="number"
          name="min_price"
          value="{{ request('min_price') }}"
          placeholder="€ Mín"
          class="w-1/2 px-2 py-1 border rounded"
        >
        <input
          type="number"
          name="max_price"
          value="{{ request('max_price') }}"
          placeholder="€ Máx"
          class="w-1/2 px-2 py-1 border rounded"
        >
      </div>

      <button type="submit" class="mt-3 w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
        Buscar
      </button>
    </form>
  </div>
</div>
