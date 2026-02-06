<?php
require_once __DIR__ . '/../models/UsuarioModel.php';

class LoginController {
    private $usuario;

    public function __construct($pdo) {
        $this->usuario = new UsuarioModel($pdo);
    }

    public function login() {
    
        if (isset($_SESSION['usuario_id'])) {
            header('Location: /home');
            exit;
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';
    
            $usuario = $this->usuario->verificarSenha($email, $senha);

            if ($usuario) {
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nome'] = $usuario['nome'];
                $_SESSION['perfil'] = $usuario['perfil'];
    
                header('Location: /home');
                exit;
            } else {
                echo "E-mail ou senha incorretos!";
            }
        } else {
            require_once __DIR__ . '/../views/login.php';
        }
    }
}