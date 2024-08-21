document.addEventListener('DOMContentLoaded', () => {
    // Selecciona el botón con la clase 'register-submit'
    const submitButton = document.querySelector('.login-submit');
    
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
        // Obtén los datos del formulario
        const data = new FormData(form);

        // Convierte FormData a un objeto JSON
        const jsonData = JSON.stringify(Object.fromEntries(data.entries()));

        try {
            const response = await fetch('http://localhost/api/index.php/auth/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: jsonData,
            });

            const result = await response.json();
            
            if (response.ok) {
                alert('Registro exitoso');
                window.location.href = 'register.php';
            } else {
                alert('Error: ' + result.message);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Hubo un problema con la solicitud.');
        }
    }
});
