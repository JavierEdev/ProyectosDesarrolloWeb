document.addEventListener('DOMContentLoaded', () => {

    const token = localStorage.getItem('authToken');

    const addButton = document.querySelector('.add-button');
    if (addButton) {
        addButton.addEventListener('click', () => {
            // Redirige a agregarProducto.php con el token en la URL
            window.location.href = `agregarProducto.php?token=${token}`;
        });
    }

    fetch('http://localhost/api/index.php/products', {
        method: 'GET',
        headers: {
            'Authorization': 'Bearer ' + token,
            'Content-Type': 'application/json',
        },
    })
    .then(response => response.json())
    .then(data => {
        const productList = document.getElementById('product-list');
        data.forEach(product => {
            const productItem = document.createElement('div');
            productItem.className = 'product-item';
            productItem.innerHTML = `
                <h2>${product.name}</h2>
                <p>ID: ${product.id}</p>
                <p>${product.description}</p>
                <p><strong>Precio:</strong> $${product.price}</p>
                <p><small>Creado el: ${product.created_at}</small></p>
                <button class="update-button" data-id="${product.id}">Actualizar</button>
                <button class="delete-button" data-id="${product.id}">Eliminar</button>
            `;
            productList.appendChild(productItem);
        });

        // Añadir eventos a los botones de actualizar y eliminar
        document.querySelectorAll('.update-button').forEach(button => {
            button.addEventListener('click', (e) => {
                const productId = e.target.getAttribute('data-id');
                window.location.href = `actualizarProducto.php?id=${productId}&token=${token}`;
            });
        });

        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', (e) => {
                const productId = e.target.getAttribute('data-id');
                if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
                    fetch(`http://localhost/api/index.php/products/${productId}`, {
                        method: 'DELETE',
                        headers: {
                            'Authorization': 'Bearer ' + token,
                            'Content-Type': 'application/json',
                        },
                    })
                    .then(response => {
                        if (response.ok) {
                            alert('Producto eliminado correctamente');
                            location.reload(); // Recargar la página para reflejar los cambios
                        } else {
                            alert('Error al eliminar el producto');
                        }
                    })
                    .catch(error => {
                        console.error('Error al eliminar el producto:', error);
                    });
                }
            });
        });

    })
    .catch(error => {
        console.error('Error al obtener productos:', error);
    });
});
