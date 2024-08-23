<?php
header("Access-Control-Allow-Origin: *"); // Permite todas las orígenes. Cambia * por tu dominio específico si quieres permitir solo ciertos dominios.
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); // Métodos permitidos
header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Encabezados permitidos

// Para manejar solicitudes OPTIONS, que son enviadas por el navegador para verificar permisos CORS
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit; // Termina la solicitud OPTIONS aquí
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="css/vistaItemsGeneral.css">
</head>
<body>
    <div class="container">
        <h1>Lista de Productos</h1>
        <button class="add-button" onclick="window.location.href='agregarProducto.php'">Agregar</button>
        <div id="product-list" class="product-list">
            <!-- Aquí se mostrarán los productos -->
        </div>
    </div>

    <script src="js/vistaItems.js"></script>
</body>
</html>
