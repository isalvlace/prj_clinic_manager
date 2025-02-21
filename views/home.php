<?php
session_start();

if (!isset($_SESSION["usuario_id"])) {
    header("Location: /login");
    exit();
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . "/../controllers/HomeController.php";

$homeController = new HomeController();
$homeController->index();
?>