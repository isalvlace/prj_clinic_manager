<?php
session_start();

// Verifica se o usuário está autenticado
if (!isset($_SESSION["usuario_id"])) {
    header("Location: index.php?page=login");
    exit();
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once __DIR__ . "/components/head.php";  
include_once __DIR__ . "/components/sidebar.php";  
include_once __DIR__ . "/components/navbar.php";  
include_once __DIR__ . "/components/dashboard.php";  
include_once __DIR__ . "/components/footer.php";  

?>
