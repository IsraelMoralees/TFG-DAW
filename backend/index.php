<?php
require_once 'includes/init.php';
require_once 'config/database.php';

// Manejo básico de rutas
$route = $_GET['route'] ?? 'home';

// Enrutamiento simple
switch ($route) {
    case 'home':
        require_once 'controllers/HomeController.php';
        $controller = new HomeController();
        $controller->index();
        break;
    // Agregar más rutas según sea necesario
    default:
        header("HTTP/1.0 404 Not Found");
        require_once 'views/404.php';
        break;
}
?>
