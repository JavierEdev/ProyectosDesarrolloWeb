<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit;
}

$productID = isset($_GET['id']) ? $_GET['id'] : null;
$token = isset($_GET['token']) ? $_GET['token'] : null;

$product = null;
if ($productID && $token) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost/api/index.php/products/$productID");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $token",
        "Content-Type: application/json",
    ]);
    $response = curl_exec($ch);
    curl_close($ch);
    $product = json_decode($response, true);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $updatedProduct = [
        'name' => $_POST['name'],
        'description' => $_POST['description'],
        'price' => $_POST['price']
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://localhost/api/index.php/products/$productID");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($updatedProduct));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $token",
        "Content-Type: application/json",
    ]);
    $response = curl_exec($ch);
    curl_close($ch);

    header("Location: vistaItems.php?token=$token");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar Producto</title>
    <link rel="stylesheet" href="css/actualizarProducto.css">
</head>
<body>
    <div class="container">
        <h2>Actualizar Producto</h2>
        <?php if ($product): ?>
        <form method="POST" id="updateProductForm">
            <div class="form-group">
                <label for="name">Nombre del Producto:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Descripción:</label>
                <textarea id="description" name="description" required><?php echo htmlspecialchars($product['description']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="price">Precio:</label>
                <input type="number" step="0.01" id="price" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required>
            </div>
            <button type="submit" class="update-submit">Actualizar Producto</button>
        </form>
        <?php else: ?>
            <p>Producto no encontrado.</p>
        <?php endif; ?>
    </div>
</body>
</html>
