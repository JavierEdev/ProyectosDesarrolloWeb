document.addEventListener('DOMContentLoaded', () => {
    // Selecciona el formulario
    const form = document.getElementById('addProductForm');

    // Recupera el token de la URL
    const urlParams = new URLSearchParams(window.location.search);
    const token = urlParams.get('token');

    if (form && token) {
        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            // Obtén los datos del formulario
            const formData = new FormData(form);

            // Convierte FormData a un objeto JSON
            const jsonData = JSON.stringify(Object.fromEntries(formData.entries()));

            try {
                const response = await fetch('http://localhost:5012/api/products', { // Cambié el puerto a 5012
                    method: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + token,
                        'Content-Type': 'application/json',
                    },
                    body: jsonData,
                });

                if (response.ok) {
                    alert('Producto agregado exitosamente');
                    window.location.href = `vistaItems.php?token=${token}`; // Redirige a la lista de productos
                } else {
                    const result = await response.json();
                    alert('Error: ' + (result.message || 'Error al agregar el producto'));
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Hubo un problema con la solicitud.');
            }
        });
    } else {
        console.error('Formulario o token no encontrados.');
    }
});
