<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit;
}

// Recuperar el token de la URL
$token = isset($_GET['token']) ? $_GET['token'] : null;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
    <link rel="stylesheet" href="css/agergarItems.css">
</head>
<body>
    <div class="container">
        <h1>Agregar Producto</h1>
        <form id="addProductForm">
            <div class="form-group">
                <label for="name">Nombre del Producto:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="description">Descripción:</label>
                <textarea id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="price">Precio:</label>
                <input type="text" id="price" name="price" required>
            </div>
            <button type="submit" class="submit-button">Agregar Producto</button>
        </form>
    </div>

    <script src="js/agregarProducto.js"></script>
</body>
</html>
