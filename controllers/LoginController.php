<?php
require_once __DIR__ . '/../models/Usuario.php';

class LoginController {
    private $usuario;

    public function __construct($pdo) {
        $this->usuario = new Usuario($pdo);
    }

    public function login() {
        session_start();
    
        if (isset($_SESSION['usuario_id'])) {
            header('Location: /prj_clinic_manager/home');
            exit;
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';
    
            $usuario = $this->usuario->verificarSenha($email, $senha);
    
            if ($usuario) {
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nome'] = $usuario['nome'];
                $_SESSION['permissao_id'] = $usuario['permissao_id'];
    
                header('Location: /prj_clinic_manager/home');
                exit;
            } else {
                echo "E-mail ou senha incorretos!";
            }
        } else {
            require_once __DIR__ . '/../views/login.php';
        }
    }
}