// Función para realizar peticiones AJAX
async function fetchData(url, options = {}) {
    try {
        const response = await fetch(url, {
            ...options,
            headers: {
                'Content-Type': 'application/json',
                ...options.headers
            }
        });
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        return await response.json();
    } catch (error) {
        console.error('Error:', error);
        throw error;
    }
}

// Inicialización de la aplicación
document.addEventListener('DOMContentLoaded', () => {
    // Aquí irá la lógica de inicialización
    console.log('Aplicación iniciada');
});
