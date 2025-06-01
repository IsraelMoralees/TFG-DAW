// resources/js/contact.js

// Esperamos a que todo el HTML del DOM esté cargado
document.addEventListener('DOMContentLoaded', () => {
  // Buscamos el formulario por su ID
  const form = document.getElementById('contact-form');
  if (!form) return; // Si no existe, salimos

  form.addEventListener('submit', function(e) {
    e.preventDefault(); // Evita el envío al servidor y la recarga

    // Oculta el contenedor del formulario
    const formContainer = document.getElementById('form-container');
    if (formContainer) {
      formContainer.classList.add('hidden');
    }

    // Muestra el mensaje de agradecimiento
    const thankYou = document.getElementById('thank-you');
    if (thankYou) {
      thankYou.classList.remove('hidden');
    }
  });
});
