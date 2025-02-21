<?php

class Router {
    private $routes = [];

    public function addRoute($method, $url, $controller, $action) {
        $this->routes[] = [
            'method' => $method,
            'url' => $url,
            'controller' => $controller,
            'action' => $action
        ];
    }

    public function dispatch($requestUri, $requestMethod, $pdo) {
        $basePath = '/prj_clinic_manager';
        $requestUri = parse_url($requestUri, PHP_URL_PATH);
        $requestUri = str_replace($basePath, '', $requestUri);

        if ($requestUri === '/' || $requestUri === '') {
            header("Location: {$basePath}/login");
            exit();
        }

        if ($requestUri === '/login' && $requestMethod === 'GET') {
            require_once __DIR__ . '/views/login.php';
            return;
        }

        foreach ($this->routes as $route) {
            if ($route['url'] === $requestUri && $route['method'] === $requestMethod) {
                $controller = new $route['controller']($pdo);
                $action = $route['action'];
                $controller->$action();
                return;
            }
        }

        http_response_code(404);
        echo "Erro 404: Rota não encontrada!";
    }
}