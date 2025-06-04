{{-- resources/views/layouts/navigation.blade.php --}}
<nav x-data="{ open: false, openAdmin: false, openProfile: false }" class="bg-gradient-to-r from-purple-600 to-indigo-600 border-b border-purple-700">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex h-16 items-center justify-between">

      {{-- IZQUIERDA: logo + navegación principal (oculto en móvil) --}}
      <div class="hidden sm:flex items-center space-x-6">
        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex-shrink-0">
          <x-application-logo class="h-12 w-auto text-white" />
        </a>

        {{-- Enlaces principales --}}
        <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="text-white">
          {{ __('Inicio') }}
        </x-nav-link>
        <x-nav-link :href="route('catalogo')" :active="request()->routeIs('catalogo*')" class="text-white">
          {{ __('Catálogo') }}
        </x-nav-link>
        <x-nav-link :href="route('contacto')" :active="request()->routeIs('contacto')" class="text-white">
          {{ __('Contacto') }}
        </x-nav-link>

        @auth
          @if(auth()->user()->isAdmin())
            {{-- Dropdown “Panel Admin” en escritorio --}}
            <x-dropdown
              align="right"
              width="48"
              contentClasses="bg-white/20 backdrop-blur-lg border border-white/20 rounded-lg shadow-xl py-2">
              <x-slot name="trigger">
                <button class="flex items-center text-white hover:text-gray-100 focus:outline-none">
                  {{ __('Panel Admin') }}
                  <svg class="ml-1 h-4 w-4 fill-current transition-transform duration-200"
                       :class="{ 'rotate-180': openAdmin }"
                       viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                          d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 011.08 1.04l-4.25 4.25a.75.75 0 01-1.08 0L5.23 8.27a.75.75 0 01.02-1.06z"
                          clip-rule="evenodd" />
                  </svg>
                </button>
              </x-slot>

              <x-slot name="content">
                <x-dropdown-link
                  :href="route('admin.videojuegos.index')"
                  class="block px-4 py-2 text-white bg-transparent hover:bg-gradient-to-r hover:from-indigo-500 hover:to-purple-500 transition-colors rounded-md">
                  {{ __('Videojuegos') }}
                </x-dropdown-link>
                <x-dropdown-link
                  :href="route('admin.users.index')"
                  class="block px-4 py-2 text-white bg-transparent hover:bg-gradient-to-r hover:from-indigo-500 hover:to-purple-500 transition-colors rounded-md">
                  {{ __('Users') }}
                </x-dropdown-link>
              </x-slot>
            </x-dropdown>
          @endif
        @endauth
      </div>

      {{-- DERECHA: buscador + carrito + usuario (oculto en móvil) --}}
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
          <x-dropdown
            align="right"
            width="200"
            contentClasses="bg-white/20 backdrop-blur-lg border border-white/20 rounded-lg shadow-xl py-1">
            <x-slot name="trigger">
              <button class="flex items-center text-white hover:text-gray-100 focus:outline-none">
                {{ Auth::user()->name }}
                <svg class="ml-1 h-4 w-4 fill-current transition-transform duration-200"
                     :class="{ 'rotate-180': openProfile }"
                     viewBox="0 0 20 20">
                  <path fill-rule="evenodd"
                        d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 011.08 1.04l-4.25 4.25a.75.75 0 01-1.08 0L5.23 8.27a.75.75 0 01.02-1.06z"
                        clip-rule="evenodd" />
                </svg>
              </button>
            </x-slot>

            <x-slot name="content">
              <x-dropdown-link
                :href="route('purchase.index')"
                class="block px-4 py-2 text-white bg-transparent hover:bg-gradient-to-r hover:from-indigo-500 hover:to-purple-500 rounded-md">
                {{ __('Historial') }}
              </x-dropdown-link>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-dropdown-link
                  :href="route('logout')"
                  onclick="event.preventDefault(); this.closest('form').submit();"
                  class="block px-4 py-2 text-white bg-transparent hover:bg-gradient-to-r hover:from-indigo-500 hover:to-purple-500 rounded-md">
                  {{ __('Log Out') }}
                </x-dropdown-link>
              </form>
            </x-slot>
          </x-dropdown>
        @endguest
      </div>

      {{-- BOTÓN MÓVIL (visible solo en <sm) --}}
      <div class="flex items-center justify-between w-full sm:hidden px-4">
        {{-- Logo en móvil --}}
        <a href="{{ route('home') }}" class="flex-shrink-0">
          <x-application-logo class="h-10 w-auto text-white" />
        </a>
        {{-- Botón hamburguesa alineado a la derecha --}}
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

  {{-- MENÚ MÓVIL DESPLEGABLE --}}
  <div x-show="open" x-cloak class="sm:hidden fixed inset-0 z-40 bg-purple-700 overflow-auto">
    {{-- Cabecera móvil: logo a la izquierda + botón “cerrar” a la derecha --}}
    <div class="flex items-center justify-between px-4 py-3 border-b border-purple-600">
      {{-- Logo --}}
      <a href="{{ route('home') }}">
        <x-application-logo class="h-12 w-auto text-white" />
      </a>
      {{-- Botón para cerrar el menú --}}
      <button @click="open = false" class="text-white focus:outline-none">
        <svg xmlns="http://www.w3.org/2000/svg"
             class="h-6 w-6"
             fill="none" viewBox="0 0 24 24"
             stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round"
                d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>

    {{-- Enlaces principales (verticales) --}}
    <div class="space-y-1 px-4 pt-2 pb-3">
      <x-nav-link
        :href="route('home')"
        :active="request()->routeIs('home')"
        class="block text-white">
        {{ __('Inicio') }}
      </x-nav-link>

      <x-nav-link
        :href="route('catalogo')"
        :active="request()->routeIs('catalogo*')"
        class="block text-white">
        {{ __('Catálogo') }}
      </x-nav-link>

      <x-nav-link
        :href="route('contacto')"
        :active="request()->routeIs('contacto')"
        class="block text-white">
        {{ __('Contacto') }}
      </x-nav-link>

      @auth
        @if(auth()->user()->isAdmin())
          {{-- Botón “Panel Admin” en móvil --}}
          <div>
            <button
              @click="openAdmin = !openAdmin"
              class="w-full flex items-center justify-between text-white px-2 py-2 hover:bg-purple-600 rounded-md focus:outline-none">
              {{ __('Panel Admin') }}
              <svg
                :class="{ 'rotate-180': openAdmin }"
                class="ml-1 h-4 w-4 fill-current transition-transform duration-200"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
                stroke="currentColor"
                stroke-width="2">
                <path fill-rule="evenodd"
                      d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 011.08 1.04l-4.25 4.25a.75.75 0 01-1.08 0L5.23 8.27a.75.75 0 01.02-1.06z"
                      clip-rule="evenodd" />
              </svg>
            </button>
            <div x-show="openAdmin" x-cloak class="mt-1 space-y-1 pl-4">
              <x-dropdown-link
                :href="route('admin.videojuegos.index')"
                class="block px-4 py-2 text-white bg-transparent hover:bg-gradient-to-r hover:from-indigo-500 hover:to-purple-500 rounded-md">
                {{ __('Videojuegos') }}
              </x-dropdown-link>
              <x-dropdown-link
                :href="route('admin.users.index')"
                class="block px-4 py-2 text-white bg-transparent hover:bg-gradient-to-r hover:from-indigo-500 hover:to-purple-500 rounded-md">
                {{ __('Users') }}
              </x-dropdown-link>
            </div>
          </div>
        @else
          {{-- Si no es admin, “Mis compras” --}}
          <x-nav-link
            :href="route('purchase.index')"
            :active="request()->routeIs('purchase.index')"
            class="block text-white">
            {{ __('Mis compras') }}
          </x-nav-link>
        @endif

        {{-- Enlace Carrito --}}
        <x-nav-link
          :href="route('cart.index')"
          class="relative block text-white">
          {{ __('Carrito') }}
          @if(session('cart') && count(session('cart')) > 0)
            <span class="ml-2 bg-red-500 text-white text-xs font-bold px-2 rounded-full">
              {{ count(session('cart')) }}
            </span>
          @endif
        </x-nav-link>

        {{-- Dropdown “Perfil” en móvil --}}
        <div>
          <button
            @click="openProfile = !openProfile"
            class="w-full flex items-center justify-between text-white px-2 py-2 hover:bg-purple-600 rounded-md focus:outline-none">
            {{ Auth::user()->name }}
            <svg
              :class="{ 'rotate-180': openProfile }"
              class="ml-1 h-4 w-4 fill-current transition-transform duration-200"
              viewBox="0 0 20 20"
              xmlns="http://www.w3.org/2000/svg"
              stroke="currentColor"
              stroke-width="2">
              <path fill-rule="evenodd"
                    d="M5.23 7.21a.75.75 0 011.06.02L10 10.94l3.71-3.71a.75.75 0 011.08 1.04l-4.25 4.25a.75.75 0 01-1.08 0L5.23 8.27a.75.75 0 01.02-1.06z"
                    clip-rule="evenodd" />
            </svg>
          </button>
          <div x-show="openProfile" x-cloak class="mt-1 space-y-1 pl-4">
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <x-dropdown-link
                :href="route('logout')"
                onclick="event.preventDefault(); this.closest('form').submit();"
                class="block px-4 py-2 text-white bg-transparent hover:bg-gradient-to-r hover:from-indigo-500 hover:to-purple-500 rounded-md">
                {{ __('Log Out') }}
              </x-dropdown-link>
            </form>
          </div>
        </div>
      @endauth

      @guest
        <x-nav-link
          :href="route('login')"
          class="block text-white">
          {{ __('Log in') }}
        </x-nav-link>
      @endguest
    </div>

    {{-- Buscador móvil --}}
    <div class="px-4 pb-3 border-t border-purple-600">
      <x-search-dropdown :action="route('catalogo')" />
    </div>
  </div>
</nav>
