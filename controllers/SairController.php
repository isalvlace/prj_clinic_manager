<?php
class SairController {
    public function logout() {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        // Remove todas as variáveis da sessão
        $_SESSION = [];

        // Destroi a sessão
        session_destroy();

        // Remove o cookie da sessão 
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        header("Location: index.php?page=login");
        exit();
    }
}
