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
        $requestUri = parse_url($requestUri, PHP_URL_PATH);

        if ($requestUri === '/' || $requestUri === '') {
            header("Location: /login");
            exit();
        }

        // Remover o prefixo antigo caso o navegador ainda tenha em cache
        $requestUri = str_replace('/prj_clinic_manager', '', $requestUri);

        // Rota fixa de Login 
        if ($requestUri === '/login' && $requestMethod === 'GET') {
            require_once __DIR__ . '/views/login.php';
            return;
        }

        // Comparação de Rotas
        foreach ($this->routes as $route) {
            if ($route['url'] === $requestUri && $route['method'] === $requestMethod) {
                $controller = new $route['controller']($pdo);
                $action = $route['action'];
                $controller->$action();
                return;
            }
        }

        http_response_code(404);
        echo "Erro 404: Rota não encontrada! Caminho tentado: " . htmlspecialchars($requestUri);
    }
}