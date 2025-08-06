<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/router.php';
require_once __DIR__ . '/controllers/LoginController.php';
require_once __DIR__ . '/controllers/HomeController.php';
require_once __DIR__ . '/controllers/SairController.php';
require_once __DIR__ . '/controllers/UsuarioController.php';


$pdo = (new Database())->getConnection();
$router = new Router();

$router->addRoute('GET', '/', 'LoginController', 'login');
$router->addRoute('GET', '/login', 'LoginController', 'login');
$router->addRoute('POST', '/login', 'LoginController', 'login');
$router->addRoute('GET', '/home', 'HomeController', 'index');
$router->addRoute('GET', '/sair', 'SairController', 'logout');
$router->addRoute('POST', '/salvar-arquivo', 'ArquivoController', 'salvarArquivo');
$router->addRoute('GET', '/buscar-usuario-nome', 'UsuarioController', 'buscarUsuarioPorNome');
$router->addRoute('POST', '/vincular-arquivo', 'ArquivoController', 'vincularArquivo');

$basePath = '/prj_clinic_manager';
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestUri = str_replace($basePath, '', $requestUri);
$requestMethod = $_SERVER['REQUEST_METHOD'];

if (!isset($_SESSION['usuario_id']) && !in_array($requestUri, ['/login', '/'])) {
    header("Location: {$basePath}/login");
    exit();
}

$router->dispatch($requestUri, $requestMethod, $pdo);