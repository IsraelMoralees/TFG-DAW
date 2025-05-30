{{-- resources/views/auth/forgot-password.blade.php --}}
<x-guest-layout>
    <!-- Particles Background -->
    <div id="particles-js" class="absolute inset-0 z-0"></div>

    <!-- Centered Gradient Panel -->
        <div class="bg-gradient-to-br from-purple-600 to-indigo-600 rounded-2xl p-8 w-full max-w-md mx-auto">

            <!-- Forgot Password Card -->
            <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl shadow-xl p-6">
                <h2 class="text-2xl font-bold text-white text-center mb-2">
                    {{ __('¿Has olvidado tu contraseña?') }}
                </h2>
                <p class="text-center text-gray-300 mb-6">
                    {{ __("No hay problema. Solo háznos saber tu dirección de correo electrónico y te enviaremos un enlace para restablecer la contraseña.") }}
                </p>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4 text-white/90" :status="session('status')" />

                <!-- Reset Link Form -->
                <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" class="text-white" />
                        <x-text-input
                            id="email"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required
                            autofocus
                            class="mt-1 w-full bg-black/80 text-white rounded-lg px-3 py-2 focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-1 text-pink-400" />
                    </div>

                    <!-- Send Reset Link Button -->
                    <div>
                        <x-primary-button class="w-full bg-gradient-to-r from-indigo-500 to-purple-500 hover:from-purple-500 hover:to-pink-500 text-white font-semibold py-2 rounded-lg shadow-md transform transition hover:scale-105">
                            {{ __('Enviar restablecimiento de contraseña') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>

            <!-- Back to Login Info Box -->
            <div class="mt-6 bg-white/20 backdrop-blur-md border border-white/30 rounded-lg p-4 text-center">
                <p class="text-sm text-gray-100">
                    {{ __("¿Recordaste tu contraseña?") }}
                    <a href="{{ route('login') }}" class="underline text-indigo-200 hover:text-white ml-1">
                        {{ __('Inicia sesión') }}
                    </a>
                </p>
            </div>
        </div>
    </div>

    <!-- Particles.js Script -->
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            particlesJS('particles-js', {
                particles: {
                    number: { value: 60, density: { enable: true, value_area: 800 } },
                    color: { value: '#ffffff' },
                    shape: { type: 'circle' },
                    opacity: { value: 0.1 },
                    size: { value: 3 },
                    line_linked: { enable: true, distance: 150, color: '#ffffff', opacity: 0.05, width: 1 },
                    move: { enable: true, speed: 0.6 }
                },
                interactivity: {
                    detect_on: 'canvas',
                    events: { onhover: { enable: false }, onclick: { enable: false } }
                },
                retina_detect: true
            });
        });
    </script>
</x-guest-layout>
