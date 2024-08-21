<?php
include_once 'config/db.php';
include_once 'helpers/Response.php';
include_once 'controllers/ProductController.php';
include_once 'controllers/AuthController.php';
include_once 'middleware/AuthMiddleware.php';

$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

$db = (new DB())->getConnection();

if (empty($uri[2])) {
    echo file_get_contents('public/index.html');
    exit();
}

switch ($uri[2]) {
    case 'public':
        // Ajusta aquí para verificar la existencia de '/public/registro.html' y '/public/login.html'
        if (isset($uri[3]) && $uri[3] === 'registro.html') {
            echo file_get_contents('api/public/registro.html');
            exit();
        }
        if (isset($uri[3]) && $uri[3] === 'login.html') {
            echo file_get_contents('api/public/login.html');
            exit();
        }
        break;

    case 'products':
        $authMiddleware = new AuthMiddleware($db);
        $user_id = $authMiddleware->authenticate();

        if ($user_id) {
            $productController = new ProductController($db);

            if ($method === 'GET' && !isset($uri[3])) {
                $productController->getAll();
            }

            if ($method === 'GET' && isset($uri[3])) {
                $productController->getSingle($uri[3]);
            }

            if ($method === 'POST') {
                $data = json_decode(file_get_contents('php://input'), true);
                $productController->create($data);
            }

            if ($method === 'PUT' && isset($uri[3])) {
                $data = json_decode(file_get_contents('php://input'), true);
                $productController->update($uri[3], $data);
            }

            if ($method === 'DELETE' && isset($uri[3])) {
                $productController->delete($uri[3]);
            }
        }
        break;

    case 'auth':
        $authController = new AuthController($db);
        if ($method === 'POST' && isset($uri[3]) && $uri[3] === 'login') {
            $data = json_decode(file_get_contents("php://input"), true);
            $authController->login($data);
        } elseif ($method === 'POST' && isset($uri[3]) && $uri[3] === 'register') {
            $data = json_decode(file_get_contents("php://input"), true);
            $authController->register($data);
        } else {
            Response::send(405, ['message' => 'Method not allowed']);
        }
        break;

    default:
        Response::send(404, ['message' => 'Not found']);
        break;
}
?>
