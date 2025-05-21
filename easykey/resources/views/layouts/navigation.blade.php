<nav x-data="{ open: false }"
  class="bg-primary text-white border-b-2 border-primary-dark">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex justify-between items-center h-16">

      {{-- Logo --}}
      <a href="{{ route('catalogo') }}" class="shrink-0">
        <x-application-logo class="block h-9 w-auto text-white" />
      </a>

      {{-- Links + buscador + perfil --}}
      <div class="flex items-center space-x-6">
        {{-- Links --}}
        <div class="hidden sm:flex sm:space-x-6">
          <x-nav-link :href="route('catalogo')"
            :active="request()->routeIs('catalogo*')"
            class="hover:text-primary-light">
            {{ __('Catálogo') }}
          </x-nav-link>
          @auth
          <x-nav-link :href="route('purchase.index')"
            class="hover:text-primary-light">
            {{ __('Mis compras') }}
          </x-nav-link>
          @if(auth()->user()->isAdmin())
          <x-nav-link :href="route('admin.videojuegos.index')"
            class="hover:text-primary-light">
            {{ __('Panel Admin') }}
          </x-nav-link>
          @endif
          @endauth
        </div>

        {{-- Buscador --}}
        <div class="relative">
          <x-search-dropdown :action="route('catalogo')"
            class="text-white hover:text-primary-light" />
        </div>

        {{-- Perfil --}}
        <div class="hidden sm:flex sm:items-center">
          @guest
          <a href="{{ route('login') }}"
            class="text-white hover:text-primary-light">
            {{ __('Log in') }}
          </a>
          @else
          <x-dropdown align="right" width="48">
            <x-slot name="trigger">
              <button class="flex items-center text-white hover:text-primary-light">
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
                  onclick="event.preventDefault(); this.closest('form').submit();"
                  class="text-primary-dark hover:text-white">
                  {{ __('Log Out') }}
                </x-dropdown-link>
              </form>
            </x-slot>
          </x-dropdown>
          @endguest
        </div>
      </div>

      {{-- Móvil --}}
      <div class="sm:hidden">
        <button @click="open = !open"
          class="text-white focus:outline-none">
          <!-- iconos hamburger / close -->
        </button>
      </div>
    </div>
  </div>

  {{-- Menú móvil desplegable… --}}
</nav>