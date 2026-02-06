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
        $email = trim($email);
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function verificarSenha($email, $senha)
    {
        $usuario = $this->buscarPorEmail($email);

        if ($usuario) {
            $senhaLimpa = trim($senha);
            $hashBanco = trim($usuario['senha']);

            if (password_verify($senhaLimpa, $hashBanco)) {
                return $usuario;
            }
        }
        return false;
    }
    public function buscarPorNome($nome)
    {
        $stmt = $this->pdo->prepare("SELECT id, nome FROM usuarios WHERE nome LIKE :nome LIMIT 1");
        $stmt->execute(['nome' => "%$nome%"]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
