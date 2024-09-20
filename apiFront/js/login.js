document.addEventListener('DOMContentLoaded', () => {
    const submitButton = document.querySelector('.login-submit');
    const form = document.getElementById('registerForm');

    if (submitButton && form) {
        submitButton.addEventListener('click', (event) => {
            event.preventDefault();
            handleFormSubmit();
        });
    }

    async function handleFormSubmit() {
        const formData = new FormData(form);
        const formObject = Object.fromEntries(formData.entries());
        const jsonData = JSON.stringify(formObject);

        try {
            const response = await fetch('http://localhost:5012/api/auth/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: jsonData,
            });

            if (!response.ok) {
                // Verifica si hay algún error en la respuesta
                const errorResult = await response.json();
                throw new Error(errorResult.message || 'Error en la solicitud');
            }

            const result = await response.json();
            
            alert('Inicio de sesión exitoso');
            localStorage.setItem('authToken', result.token);
            window.location.href = 'vistaItems.php';
        } catch (error) {
            console.error('Error:', error);
            alert('Hubo un problema con la solicitud: ' + error.message);
        }
    }
});
