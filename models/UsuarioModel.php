<?php
class UsuarioModel
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function buscarPorEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM usuario WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function verificarSenha($email, $senha)
    {
        $usuario = $this->buscarPorEmail($email);

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            return $usuario;
        }
        return false;
    }

    public function buscarPorNome($nome)
    {
        $stmt = $this->pdo->prepare("SELECT id, nome FROM usuario WHERE nome LIKE :nome LIMIT 1");
        $stmt->execute(['nome' => "%$nome%"]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
