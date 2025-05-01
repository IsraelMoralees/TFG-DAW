<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'tfg_daw');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');

try {
    $pdo = new PDO(
        "pgsql:host=" . DB_HOST . ";dbname=" . DB_NAME,
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch(PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
