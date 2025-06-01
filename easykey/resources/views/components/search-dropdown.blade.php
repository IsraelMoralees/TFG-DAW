@props(['action'])

<div x-data="{ open: false }" class="relative">
  <!-- botón que sólo muestra la lupa -->
  <button
    @click.prevent="open = !open"
    class="p-2 rounded hover:bg-white/20 dark:hover:bg-gray-700 transition-colors"
    aria-label="Buscar"
  >
    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
        d="M21 21l-4.35-4.35m0 0A7.5 7.5 0 1116.65 7.65z" />
    </svg>
  </button>

  <!-- panel desplegable -->
  <div
    x-show="open"
    @click.away="open = false"
    x-transition
    class="absolute right-0 mt-2 w-64 bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl shadow-xl z-50 p-4"
    style="display: none;"
  >
    <form method="GET" action="{{ $action }}">
      <input
        type="text"
        name="q"
        value="{{ request('q') }}"
        placeholder="Buscar por título…"
        class="w-full px-3 py-2 bg-white/10 border border-white/20 rounded-2xl text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500"
      >

      <select
        name="plataforma"
        class="w-full mt-2 px-3 py-2 bg-white/10 border border-white/20 rounded-2xl text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500"
      >
        <option value="" class="text-gray-800">— Plataforma —</option>
        @foreach(\App\Models\Videojuego::distinct()->pluck('plataforma') as $plat)
          <option
            value="{{ $plat }}"
            @if(request('plataforma') === $plat) selected @endif
            class="text-gray-800"
          >
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
          class="w-1/2 px-3 py-2 bg-white/10 border border-white/20 rounded-2xl text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500"
        >
        <input
          type="number"
          name="max_price"
          value="{{ request('max_price') }}"
          placeholder="€ Máx"
          class="w-1/2 px-3 py-2 bg-white/10 border border-white/20 rounded-2xl text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500"
        >
      </div>

      <button
        type="submit"
        class="mt-3 w-full py-2 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-2xl hover:from-purple-500 hover:to-pink-500 transform hover:scale-105 transition"
      >
        Buscar
      </button>
    </form>
  </div>
</div>
