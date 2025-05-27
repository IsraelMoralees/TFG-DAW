<nav x-data="{ open: false }"
  class="bg-primary text-white border-b-2 border-primary-dark">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center h-16">

      {{-- Logo --}}
      <a href="{{ route('catalogo') }}" class="shrink-0">
        <x-application-logo class="block h-9 w-auto text-white" />
      </a>

      {{-- Desktop --}}
      <div class="hidden sm:flex sm:items-center sm:space-x-6">
        <x-nav-link :href="route('catalogo')"
          :active="request()->routeIs('catalogo*')">
          {{ __('Catálogo') }}
        </x-nav-link>

        @auth
        {{-- Mis compras --}}
        <x-nav-link :href="route('purchase.index')"
          :active="request()->routeIs('purchase.index')">
          {{ __('Mis compras') }}
        </x-nav-link>

        {{-- Panel Admin --}}
        @if(auth()->user()->isAdmin())
        <x-nav-link :href="route('admin.videojuegos.index')"
          :active="request()->routeIs('admin.*')">
          {{ __('Panel Admin') }}
        </x-nav-link>
        @endif

        {{-- Carrito --}}
        <x-nav-link :href="route('cart.index')"
          :active="request()->routeIs('cart*')"
          class="relative">
          <svg xmlns="http://www.w3.org/2000/svg"
            class="inline-block h-5 w-5 mr-1"
            fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9
                       m5-9v9m4-9v9m5-9l2 9" />
          </svg>
          {{ __('Carrito') }}
          @if(session('cart') && count(session('cart')) > 0)
          <span class="absolute top-0 right-0 inline-flex items-center justify-center
                           px-1 text-xs font-bold leading-none text-white bg-red-500
                           rounded-full transform translate-x-1/2 -translate-y-1/2">
            {{ count(session('cart')) }}
          </span>
          @endif
        </x-nav-link>
        @endauth

        {{-- Buscador --}}
        <div class="relative">
          <x-search-dropdown :action="route('catalogo')" />
        </div>

        {{-- Perfil --}}
        @guest
        <a href="{{ route('login') }}"
          class="text-white hover:text-primary-light">
          {{ __('Log in') }}
        </a>
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

      {{-- Mobile menu button --}}
      <div class="sm:hidden">
        <button @click="open = !open" class="text-white focus:outline-none">
          <svg x-show="!open" xmlns="http://www.w3.org/2000/svg"
            class="h-6 w-6" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16" />
          </svg>
          <svg x-show="open" xmlns="http://www.w3.org/2000/svg"
            class="h-6 w-6" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M6 18L18 6M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>
  </div>

{{-- Mobile dropdown --}}
<div x-show="open" class="sm:hidden bg-primary-dark">
  <div class="px-4 pt-2 pb-3 space-y-1">
    <x-nav-link :href="route('catalogo')"
                :active="request()->routeIs('catalogo*')"
                class="block px-4 py-2 text-white hover:bg-primary hover:text-white">
      {{ __('Catálogo') }}
    </x-nav-link>

    @auth
      <x-nav-link :href="route('purchase.index')"
                  :active="request()->routeIs('purchase.index')"
                  class="block px-4 py-2 text-white hover:bg-primary hover:text-white">
        {{ __('Mis compras') }}
      </x-nav-link>

      @if(auth()->user()->isAdmin())
        <x-nav-link :href="route('admin.videojuegos.index')"
                    :active="request()->routeIs('admin.*')"
                    class="block px-4 py-2 text-white hover:bg-primary hover:text-white">
          {{ __('Panel Admin') }}
        </x-nav-link>
      @endif

      <x-nav-link :href="route('cart.index')"
                  :active="request()->routeIs('cart*')"
                  class="relative block px-4 py-2 text-white hover:bg-primary hover:text-white">
        {{ __('Carrito') }}
        @if(session('cart') && count(session('cart')) > 0)
          <span class="ml-2 bg-red-500 text-white text-xs font-bold px-2 rounded-full">
            {{ count(session('cart')) }}
          </span>
        @endif
      </x-nav-link>
    @endauth

    @guest
      <x-nav-link :href="route('login')"
                  class="block px-4 py-2 text-white hover:bg-primary hover:text-white">
        {{ __('Log in') }}
      </x-nav-link>
    @else
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <x-nav-link :href="route('logout')"
                    onclick="event.preventDefault(); this.closest('form').submit();"
                    class="block px-4 py-2 text-white hover:bg-primary hover:text-white">
          {{ __('Log Out') }}
        </x-nav-link>
      </form>
    @endguest
  </div>
</div>
</nav>

{{-- Include the search dropdown component --}}