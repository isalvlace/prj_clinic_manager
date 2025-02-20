<?php
session_start();
require_once __DIR__ . '/config/database.php';

$database = new Database();
$pdo = $database->getConnection();

$page = isset($_GET['page']) ? $_GET['page'] : 'login';

$routes = [
    'login' => 'views/login.php',
    'autenticar' => 'controllers/LoginController.php',
    'home' => 'views/home.php',
    'sair' => 'controllers/SairController.php'
];

// Verifica se a página solicitada existe nas rotas
if (array_key_exists($page, $routes)) {
    // Se for uma página de login, trata o login antes de carregar a view
    if ($page === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once 'controllers/LoginController.php';
        $loginController = new LoginController($pdo); 
        $loginController->login();
        exit;
    } else {
        require_once __DIR__ . '/' . $routes[$page];
    }
} else {
    echo "Erro 404: Página não encontrada.";
}