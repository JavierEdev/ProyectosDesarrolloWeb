document.addEventListener('DOMContentLoaded', () => {
    // Selecciona el botón con la clase 'register-submit'
    const submitButton = document.querySelector('.register-submit');
    
    // Asegúrate de que el formulario esté presente
    const form = document.getElementById('registerForm');

    if (submitButton && form) {
        // Asocia el evento de clic al botón de envío
        submitButton.addEventListener('click', (event) => {
            // Evita el comportamiento por defecto del botón de enviar
            event.preventDefault();
            handleFormSubmit();
        });
    }

    // Función para manejar el envío del formulario de registro
    async function handleFormSubmit() {
        // Crea un objeto con los datos del formulario
        const formData = new FormData(form);

        // Convierte FormData a un objeto JSON
        const jsonData = JSON.stringify({
            name: formData.get('name'),
            email: formData.get('email'),
            password: formData.get('password')
        });

        try {
            const response = await fetch('http://localhost:5012/api/auth/register', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: jsonData,
            });

            // Revisa si la respuesta del servidor fue exitosa
            if (response.ok) {
                const result = await response.json();
                alert('Registro exitoso');
                // Redirige al usuario después de un registro exitoso
                window.location.href = 'index.php';
            } else {
                // Manejo de errores
                const errorData = await response.json();
                alert('Error: ' + (errorData.message || 'Error en el registro'));
            }
        } catch (error) {
            // Captura errores de red u otros
            console.error('Error:', error);
            alert('Hubo un problema con la solicitud.');
        }
    }
});
