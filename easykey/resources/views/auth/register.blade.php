<x-guest-layout>
    <!-- Particles Background -->
    <div id="particles-js" class="absolute inset-0 z-0"></div>

    <!-- Gradient Panel -->
    <div class="bg-gradient-to-br from-purple-600 to-indigo-600 rounded-2xl p-8 w-full max-w-md mx-auto">

        <!-- Registration Card -->
        <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl shadow-xl p-2">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4 text-white/90" :status="session('status')" />

            <!-- Registration Form -->
            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- Name -->
                <div>
                    <x-input-label for="name" :value="__('Nombre')" class="text-white" />
                    <x-text-input id="name" class="mt-1 w-full bg-black/80 text-white rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-transparent" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-1 text-pink-400" />
                </div>

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Correo electrónico')" class="text-white" />
                    <x-text-input id="email" class="mt-1 w-full bg-black/80 text-white rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-transparent" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 text-pink-400" />
                </div>

                <!-- Password & Confirm Password Side by Side -->
                <div class="space-y-4">
                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Contraseña')" class="text-white" />
                        <x-text-input id="password" class="mt-1 w-full bg-black/80 text-white rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-transparent" type="password" name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-1 text-pink-400" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <x-input-label for="password_confirmation" :value="__('Confirmar Contraseña')" class="text-white" />
                        <x-text-input id="password_confirmation" class="mt-1 w-full bg-black/80 text-white rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-transparent" type="password" name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-pink-400" />
                    </div>
                </div>

                <!-- Already Registered -->
                <div class="flex items-center justify-between text-sm">
                    <p class="text-gray-200">¿Ya tienes cuenta?</p>
                    <a href="{{ route('login') }}" class="underline text-indigo-200 hover:text-white">Inicia sesión</a>
                </div>

                <!-- Register Button -->
                <div>
                    <x-primary-button class="w-full bg-gradient-to-r from-indigo-500 to-purple-500 hover:from-purple-500 hover:to-pink-500 text-white font-semibold py-2 rounded-lg shadow-md">
                        {{ __('Registrarse') }}
                    </x-primary-button>
                </div>
            </form>
        </div>

        <!-- New Info Box Under Registration -->
        <div class="mt-6 bg-white/20 backdrop-blur-md border border-white/30 rounded-lg p-4 text-center">
            <p class="text-sm text-gray-100">Explora nuestra colección de juegos después de registrarte.</p>
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