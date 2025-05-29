<nav x-data="{ open: false }" class="bg-gradient-to-r from-purple-600 to-indigo-600 border-b border-purple-700">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex h-16 items-center justify-between">
      
      {{-- IZQUIERDA: logo + navegación principal --}}
      <div class="flex items-center space-x-6">
        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex-shrink-0">
          <x-application-logo class="h-20 w-auto filter brightness-125 contrast-125 drop-shadow-lg" />
        </a>

        {{-- Enlaces principales --}}
        <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="text-white">
          {{ __('Inicio') }}
        </x-nav-link>
        <x-nav-link :href="route('catalogo')" :active="request()->routeIs('catalogo*')" class="text-white">
          {{ __('Catálogo') }}
        </x-nav-link>
        
        @auth
          <x-nav-link :href="route('purchase.index')" :active="request()->routeIs('purchase.index')" class="text-white">
            {{ __('Mis compras') }}
          </x-nav-link>
          @if (auth()->user()->isAdmin())
            <x-nav-link :href="route('admin.videojuegos.index')" :active="request()->routeIs('admin.*')" class="text-white">
              {{ __('Panel Admin') }}
            </x-nav-link>
          @endif
        @endauth
      </div>

      {{-- DERECHA: buscador + carrito + usuario --}}
      <div class="hidden sm:flex sm:items-center sm:space-x-4">
        {{-- Buscador --}}
        <div class="relative">
          <x-search-dropdown :action="route('catalogo')" />
        </div>

        {{-- Carrito --}}
        @auth
          <a href="{{ route('cart.index') }}"
             class="relative inline-flex items-center px-3 py-2 text-white hover:text-gray-200">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="h-6 w-6"
                 fill="none" viewBox="0 0 24 24"
                 stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round"
                    d="M16 11V7a4 4 0 10-8 0v4M5 11h14l-1 9H6l-1-9z" />
            </svg>
            @if(session('cart') && count(session('cart')) > 0)
              <span class="absolute top-0 right-0 inline-flex items-center justify-center
                           w-5 h-5 text-xs font-bold text-white bg-red-500 rounded-full
                           transform translate-x-1/2 -translate-y-1/2">
                {{ count(session('cart')) }}
              </span>
            @endif
          </a>
        @endauth

        {{-- Perfil / Login --}}
        @guest
          <x-nav-link :href="route('login')" class="text-white">
            {{ __('Log in') }}
          </x-nav-link>
        @else
          <x-dropdown align="right" width="48">
            <x-slot name="trigger">
              <button class="flex items-center text-white">
                {{ Auth::user()->name }}
                <svg class="ml-1 h-4 w-4 fill-current" viewBox="0 0 20 20">
                  <path fill-rule="evenodd"
                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586…"
                        clip-rule="evenodd" />
                </svg>
              </button>
            </x-slot>
            <x-slot name="content">
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-dropdown-link :href="route('logout')"
                                 onclick="event.preventDefault(); this.closest('form').submit();">
                  {{ __('Log Out') }}
                </x-dropdown-link>
              </form>
            </x-slot>
          </x-dropdown>
        @endguest
      </div>

      {{-- Botón móvil --}}
      <div class="sm:hidden">
        <button @click="open = !open" class="text-white focus:outline-none">
          <svg x-show="!open" xmlns="http://www.w3.org/2000/svg"
               class="h-6 w-6" fill="none" viewBox="0 0 24 24"
               stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M4 6h16M4 12h16M4 18h16" />
          </svg>
          <svg x-show="open" xmlns="http://www.w3.org/2000/svg"
               class="h-6 w-6" fill="none" viewBox="0 0 24 24"
               stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                  d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>

    </div>
  </div>

  {{-- Menú móvil similar: --}}
  <div x-show="open" class="sm:hidden bg-purple-700">
    <div class="space-y-1 px-2 pt-2 pb-3">
      {{-- Mismos links: Inicio, Catálogo, Mis compras, Panel Admin --}}
      <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="block text-white">
        {{ __('Inicio') }}
      </x-nav-link>
      <x-nav-link :href="route('catalogo')" :active="request()->routeIs('catalogo*')" class="block text-white">
        {{ __('Catálogo') }}
      </x-nav-link>
      @auth
        <x-nav-link :href="route('purchase.index')" :active="request()->routeIs('purchase.index')" class="block text-white">
          {{ __('Mis compras') }}
        </x-nav-link>
        @if (auth()->user()->isAdmin())
          <x-nav-link :href="route('admin.videojuegos.index')" :active="request()->routeIs('admin.*')" class="block text-white">
            {{ __('Panel Admin') }}
          </x-nav-link>
        @endif
      @endauth
      {{-- Carrito --}}
      @auth
        <x-nav-link :href="route('cart.index')" class="relative block text-white">
          {{ __('Carrito') }}
          @if(session('cart') && count(session('cart')) > 0)
            <span class="ml-2 bg-red-500 text-white text-xs font-bold px-2 rounded-full">
              {{ count(session('cart')) }}
            </span>
          @endif
        </x-nav-link>
      @endauth
      @guest
        <x-nav-link :href="route('login')" class="block text-white">
          {{ __('Log in') }}
        </x-nav-link>
      @endguest
    </div>
    <div class="px-4 pb-3">
      <x-search-dropdown :action="route('catalogo')" />
    </div>
  </div>
</nav>
