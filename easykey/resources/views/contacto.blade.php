{{-- resources/views/contacto.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-r from-purple-600 to-indigo-600 py-12 px-4 sm:px-6 lg:px-8 relative">
    <div id="particles-js" class="absolute inset-0 z-0"></div>

    <div class="max-w-xl w-full space-y-8 bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl p-8 shadow-xl relative z-10">
        <h2 class="text-center text-3xl font-bold text-white">
            Contáctanos
        </h2>

        <form id="contact-form" class="space-y-6">
            {{-- Nombre --}}
            <div>
                <label for="name" class="block text-white font-semibold mb-2">Nombre</label>
                <input type="text" id="name" name="name" required
                       class="w-full bg-white/20 text-white rounded-lg px-4 py-2 border border-white/30 focus:outline-none focus:ring-2 focus:ring-purple-500"
                       placeholder="Tu nombre">
            </div>

            {{-- Email --}}
            <div>
                <label for="email" class="block text-white font-semibold mb-2">Correo electrónico</label>
                <input type="email" id="email" name="email" required
                       class="w-full bg-white/20 text-white rounded-lg px-4 py-2 border border-white/30 focus:outline-none focus:ring-2 focus:ring-purple-500"
                       placeholder="ejemplo@correo.com">
            </div>

            {{-- Mensaje --}}
            <div>
                <label for="message" class="block text-white font-semibold mb-2">Mensaje</label>
                <textarea id="message" name="message" rows="4" required
                          class="w-full bg-white/20 text-white rounded-lg px-4 py-2 border border-white/30 resize-none focus:outline-none focus:ring-2 focus:ring-purple-500"
                          placeholder="Escribe tu mensaje..."></textarea>
            </div>

            {{-- Botón Enviar --}}
            <button type="submit"
                    class="w-full py-3 bg-gradient-to-r from-indigo-500 to-purple-500 text-white rounded-xl font-semibold hover:from-purple-500 hover:to-pink-500 hover:scale-105 transition-transform">
                Enviar
            </button>
        </form>

        {{-- Mensaje de agradecimiento (oculto por defecto) --}}
        <div id="thank-you" class="hidden text-center bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl p-6 shadow-xl">
            <h2 class="text-3xl font-bold text-white mb-4">¡Gracias!</h2>
            <p class="text-gray-300">Gracias por enviar el formulario. Pronto te contactaremos.</p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            particlesJS('particles-js', {
                particles: {
                    number: { value: 100, density: { enable: true, value_area: 800 } },
                    color: { value: '#ffffff' },
                    shape: { type: 'circle' },
                    opacity: { value: 0.2 },
                    size: { value: 4 },
                    line_linked: { enable: true, distance: 150, color: '#ffffff', opacity: 0.1, width: 1 },
                    move: { enable: true, speed: 1.5 }
                },
                interactivity: {
                    detect_on: 'canvas',
                    events: { onhover: { enable: true, mode: 'repulse' }, onclick: { enable: true, mode: 'push' } },
                    modes: { repulse: { distance: 100, duration: 0.4 }, push: { particles_nb: 4 } }
                },
                retina_detect: true
            });
        });
    </script>
@endpush
