<x-guest-layout>
    <!-- Particles Background -->
    <div id="particles-js" class="absolute inset-0 z-0"></div>
    <!-- Gradient Panel -->
    <div class="bg-gradient-to-br from-purple-600 to-indigo-600 rounded-2xl p-8 w-full max-w-md mx-auto">
        <!-- Tagline Box -->
        <div class="mb-6 bg-white/20 backdrop-blur-md border border-white/30 rounded-lg p-4 text-center">
            <h2 class="text-lg font-bold text-white">Tu puerta de entrada a aventuras épicas</h2>
        </div>

        <!-- Login Card -->
        <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl shadow-xl p-6">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4 text-white/90" :status="session('status')" />

            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf
                <div>
                    <x-input-label for="email" :value="__('Correo electrónico')" class="text-white" />
                    <x-text-input id="email"
                        class="mt-1 w-full bg-black/80 text-white rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-pink-400" />
                </div>
                <div>
                    <x-input-label for="password" :value="__('Contraseña')" class="text-white" />
                    <x-text-input id="password"
                        class="mt-1 w-full bg-black/80 text-white rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1 text-pink-400" />
                </div>
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="h-4 w-4 text-indigo-600 bg-white/10 border-white/30 rounded focus:ring-indigo-500" name="remember" />
                        <span class="ml-2 text-sm text-gray-200">{{ __('Recordarme') }}</span>
                    </label>
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-sm text-gray-200 underline hover:text-white">{{ __('¿Olvidaste tu contraseña?') }}</a>
                    @endif
                </div>
                <div>
                    <x-primary-button class="w-full bg-gradient-to-r from-indigo-500 to-purple-500 hover:from-purple-500 hover:to-pink-500 text-white font-semibold py-2 rounded-lg shadow-md">
                        {{ __('Iniciar sesión') }}
                    </x-primary-button>
                </div>
            </form>
        </div>

        <!-- New Info Box Under Login -->
        <div class="mt-6 bg-white/20 backdrop-blur-md border border-white/30 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-100">¿Nuevo aquí? <a href="{{ route('register') }}" class="underline text-indigo-200 hover:text-white">Regístrate ahora</a> y explora miles de juegos.</p>
        </div>
    </div>

    <!-- Particles.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            particlesJS('particles-js', {
                particles: {
                    number: {
                        value: 60,
                        density: {
                            enable: true,
                            value_area: 800
                        }
                    },
                    color: {
                        value: '#ffffff'
                    },
                    shape: {
                        type: 'circle'
                    },
                    opacity: {
                        value: 0.1
                    },
                    size: {
                        value: 3
                    },
                    line_linked: {
                        enable: true,
                        distance: 150,
                        color: '#ffffff',
                        opacity: 0.05,
                        width: 1
                    },
                    move: {
                        enable: true,
                        speed: 0.6
                    }
                },
                interactivity: {
                    detect_on: 'canvas',
                    events: {
                        onhover: {
                            enable: false
                        },
                        onclick: {
                            enable: false
                        }
                    }
                },
                retina_detect: true
            });
        });
    </script>
</x-guest-layout>