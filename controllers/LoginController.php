<?php
class LoginController {
    private $usuario;

    public function __construct($pdo) {
        require_once 'models/Usuario.php';
        $this->usuario = new Usuario($pdo);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';

            $usuario = $this->usuario->verificarSenha($email, $senha);

            if ($usuario) {
                $_SESSION['usuario_id'] = $usuario['id']; 
                $_SESSION['usuario_nome'] = $usuario['nome']; 
                $_SESSION['permissao_id'] = $usuario['permissao_id'];
                header('Location: index.php?page=home'); 
                exit;
            } else {
                echo "E-mail ou senha incorretos!";
            }
        }
    }
}