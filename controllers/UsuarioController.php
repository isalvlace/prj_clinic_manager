<?php
require_once __DIR__ . '/../models/UsuarioModel.php';

class UsuarioController
{
    private $usuarioModel;

    public function __construct($pdo)
    {
        $this->usuarioModel = new UsuarioModel($pdo);
    }

    // Método para buscar usuário por nome (via GET)
    public function buscarUsuarioPorNome()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['nome'])) {
            $nome = trim($_GET['nome']);

            $resultado = $this->usuarioModel->buscarPorNome($nome);

            if ($resultado) {
                header('Content-Type: application/json');
                echo json_encode($resultado);
            } else {
                http_response_code(404);
                echo json_encode(['erro' => 'Usuário não encontrado']);
            }
        } else {
            http_response_code(400);
            echo json_encode(['erro' => 'Requisição inválida']);
        }
    }
}