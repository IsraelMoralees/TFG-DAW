<?php
class HomeController {
    private $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }

    public function index() {
        // Aquí puedes agregar lógica de negocio
        require_once 'views/home.php';
    }
}
?>
