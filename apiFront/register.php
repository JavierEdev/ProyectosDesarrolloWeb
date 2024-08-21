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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="css/login.css">
    <script src="js/register.js"></script>
</head>
<body>
    <div class="container">
        <h2>Registro de Usuario</h2>
        <form id="registerForm">
            <div class="form-group">
                <label for="name">Nombre:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="register-submit">Registrarse</button>
        </form>
        <p>Ya tienes una cuenta? <a href="index.php">Inicia sesión aquí</a></p>
    </div>
</body>
</html>
