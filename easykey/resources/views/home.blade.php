{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('content')
  <!-- Hero con partículas animadas de fondo -->
  <section class="relative h-screen overflow-hidden">
    <!-- Canvas para las partículas -->
    <canvas id="particleCanvas" class="absolute inset-0"></canvas>

    <!-- Contenido centrado sobre el canvas -->
    <div class="relative z-10 flex flex-col items-center justify-center h-full px-4 sm:px-6 lg:px-8">
      <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl shadow-2xl p-12 max-w-lg w-full text-center">
        <h1 class="text-5xl sm:text-6xl font-extrabold text-white mb-4 drop-shadow-lg">
          ¡Bienvenido a EasyKey!
        </h1>
        <p class="text-lg sm:text-xl text-gray-300 mb-8">
          Tu universo de keys de videojuegos, con ofertas exclusivas y títulos imprescindibles.
        </p>
        <a href="{{ route('catalogo') }}"
           class="inline-block bg-gradient-to-r from-indigo-400 to-purple-500 hover:from-indigo-500 hover:to-purple-600 
                  text-white font-semibold py-3 px-8 rounded-2xl shadow-lg transition-transform transform hover:scale-105 duration-200">
          Explorar Catálogo
        </a>
      </div>
    </div>
  </section>

  <!-- ==================== SECCIÓN “JUEGOS DESTACADOS” ==================== -->
  @if(isset($promocionados) && $promocionados->isNotEmpty())
    <section id="destacados" class="py-16 bg-gradient-to-tr from-purple-800 to-indigo-900">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl font-extrabold text-white">Juegos Destacados</h2>
        <p class="mt-2 text-lg text-gray-300">Estos son algunos de los títulos de nuestro catálogo.</p>

        <div class="mt-10 inline-grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 justify-center">
          @foreach($promocionados as $juego)
            <a href="{{ route('catalogo') }}"
               class="w-64 bg-white/10 backdrop-blur-lg border border-white/20
                      rounded-2xl shadow-xl overflow-hidden hover:scale-105 transform transition-transform duration-200">
              {{-- Imagen del videojuego (si existe) --}}
              @if($juego->imagen)
                <img src="{{ asset($juego->imagen) }}"
                     alt="{{ $juego->titulo }}"
                     class="w-full h-32 object-cover">
              @else
                <div class="w-full h-32 bg-gray-700 flex items-center justify-center">
                  <span class="text-gray-400 text-sm">Sin imagen</span>
                </div>
              @endif

              {{-- Título y plataforma --}}
              <div class="p-4 text-white text-center">
                <h3 class="font-medium">{{ $juego->titulo }}</h3>
                <p class="text-sm text-gray-300">{{ $juego->plataforma }}</p>
              </div>
            </a>
          @endforeach
        </div>
      </div>
    </section>
  @endif
  <!-- ================ FIN SECCIÓN “JUEGOS DESTACADOS” ================ -->
<!-- About Section -->
<section id="about" class="py-16 bg-gray-900">
  <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <h2 class="text-4xl font-extrabold text-white">
      ¿Quiénes Somos?
    </h2>
    <p class="mt-4 text-lg text-gray-300">
      En EasyKey, somos un equipo de apasionados gamers dedicados a ofrecer las mejores keys digitales: seguras, rápidas y al mejor precio. Nuestro objetivo es que cada partida sea inolvidable.
    </p>
    <div class="mt-10 flex flex-col md:flex-row justify-center items-center space-y-8 md:space-y-0 md:space-x-8">
      <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl shadow-lg p-8 flex-1">
        <h3 class="text-2xl font-semibold text-white mb-2">Nuestra Misión</h3>
        <p class="text-gray-300 text-sm">
          Facilitar el acceso a juegos digitales con la máxima seguridad y atención personalizada.
        </p>
      </div>
      <div class="bg-white/10 backdrop-blur-lg border border-white/20 rounded-2xl shadow-lg p-8 flex-1">
        <h3 class="text-2xl font-semibold text-white mb-2">Nuestra Visión</h3>
        <p class="text-gray-300 text-sm">
          Convertirnos en la tienda de keys de referencia para la comunidad gamer hispanohablante.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="bg-gradient-to-r from-purple-600 to-indigo-600 py-6">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
    <p class="text-gray-200 text-sm">© {{ date('Y') }} EasyKey. Todos los derechos reservados.</p>

    <div class="mt-4 flex justify-center space-x-4">
      <a href="/" class="text-gray-200 hover:text-white">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
          <path d="M22 12c0-5.522-4.477-10-10-10S2 6.478 2 12c0 4.991 3.656 9.128 8.438 9.878v-6.987H7.898v-2.89h2.54V9.797c0-2.507 1.492-3.89 3.777-3.89 1.094 0 2.238.197 2.238.197v2.459h-1.261c-1.243 0-1.63.772-1.63 1.562v1.875h2.773l-.443 2.89h-2.33v6.987C18.344 21.128 22 16.991 22 12z"/>
        </svg>
      </a>
      <a href="/" class="text-gray-200 hover:text-white">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
          <path d="M22.46 6c-.77.35-1.6.58-2.46.69a4.3 4.3 0 001.88-2.37 8.59 8.59 0 01-2.72 1.04 4.28 4.28 0 00-7.29 3.9A12.12 12.12 0 013 5.9a4.28 4.28 0 001.33 5.72 4.24 4.24 0 01-1.94-.54v.05a4.28 4.28 0 003.43 4.2 4.28 4.28 0 01-1.93.07 4.28 4.28 0 004 2.97A8.58 8.58 0 012 19.54 12.1 12.1 0 008.29 21c7.55 0 11.68-6.26 11.68-11.68l-.01-.53A8.36 8.36 0 0022.46 6z"/>
        </svg>
      </a>
      <a href="/" class="text-gray-200 hover:text-white">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
          <path d="M7.75 2A5.75 5.75 0 002 7.75v8.5A5.75 5.75 0 007.75 22h8.5A5.75 5.75 0 0022 16.25v-8.5A5.75 5.75 0 0016.25 2h-8.5zM12 7.5a4.5 4.5 0 110 9 4.5 4.5 0 010-9zm5.5-.25a1.25 1.25 0 11-2.5 0 1.25 1.25 0 012.5 0zM12 9.5a2.5 2.5 0 100 5 2.5 2.5 0 000-5z"/>
        </svg>
      </a>
    </div>
  </div>
</footer>
  <!-- Script para animar las partículas -->
  <script>
    (function() {
      const canvas = document.getElementById('particleCanvas');
      const ctx = canvas.getContext('2d');
      let width, height, particles;

      // Redimensiona canvas al tamaño de la ventana
      function resize() {
        width = canvas.width = window.innerWidth;
        height = canvas.height = window.innerHeight;
      }

      // Constructor de cada partícula
      function Particle() {
        this.reset();
      }

      Particle.prototype.reset = function() {
        // Posición inicial al azar en toda la pantalla
        this.x = Math.random() * width;
        this.y = Math.random() * height;
        // Radio pequeño y aleatorio
        this.radius = 1 + Math.random() * 2;
        // Velocidad aleatoria en x e y (entre -0.5 y +0.5)
        this.vx = (Math.random() - 0.5) * 0.5;
        this.vy = (Math.random() - 0.5) * 0.5;
        // Opacidad inicial
        this.alpha = 0.2 + Math.random() * 0.3;
      };

      Particle.prototype.update = function() {
        this.x += this.vx;
        this.y += this.vy;
        // Si sale del área del canvas, reubicar al azar
        if (this.x < 0 || this.x > width || this.y < 0 || this.y > height) {
          this.reset();
        }
      };

      Particle.prototype.draw = function(ctx) {
        ctx.beginPath();
        ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
        ctx.fillStyle = 'rgba(255, 255, 255,' + this.alpha + ')';
        ctx.fill();
      };

      // Inicializa las partículas
      function initParticles() {
        particles = [];
        const count = Math.floor((window.innerWidth + window.innerHeight) / 15);
        for (let i = 0; i < count; i++) {
          particles.push(new Particle());
        }
      }

      // Bucle de animación
      function animate() {
        ctx.clearRect(0, 0, width, height);
        particles.forEach(p => {
          p.update();
          p.draw(ctx);
        });
        requestAnimationFrame(animate);
      }

      // Configuración inicial y escuchadores
      window.addEventListener('resize', () => {
        resize();
        initParticles();
      });

      // Al cargar, inicializa y comienza animación
      window.addEventListener('DOMContentLoaded', () => {
        resize();
        initParticles();
        animate();
      });
    })();
  </script>
@endsection