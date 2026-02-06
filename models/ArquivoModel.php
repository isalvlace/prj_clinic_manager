<?php
class ArquivoModel
{
    private $pdo;

    public function __construct($database)
    {
        $this->pdo = $database;
    }

    public function getArquivos()
    {
        $query = "SELECT a.*, u.nome as nome_usuario FROM arquivos a
            LEFT JOIN usuarios u ON a.usuario_id = u.id 
            ORDER BY a.criado_em DESC";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function salvarArquivo(?int $usuarioId, $nome, $caminho)
    {
        $query = "INSERT INTO arquivos (usuario_id, nome, caminho, criado_em) 
                VALUES (:usuario_id, :nome_arquivo, :caminho, NOW())";
        
        $stmt = $this->pdo->prepare($query);
        
        return $stmt->execute([
            ':usuario_id'    => $usuarioId, 
            ':nome_arquivo'  => $nome,
            ':caminho'       => $caminho,
        ]);
    }

    public function vincularAoUsuario($usuarioId, $arquivoId)
    {
        try {
            $sql = "UPDATE arquivos SET usuario_id = :usuario_id WHERE id = :arquivo_id";
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindParam(':usuario_id', $usuarioId, PDO::PARAM_INT);
            $stmt->bindParam(':arquivo_id', $arquivoId, PDO::PARAM_INT);

            return $stmt->execute();
        } catch (PDOException $e) {
            // error_log("Erro ao vincular arquivo: " . $e->getMessage());
            var_dump($e->getMessage());
            return false;
        }
    }

    public function beginTransaction()
    {
        $this->pdo->beginTransaction();
    }

    public function commit()
    {
        $this->pdo->commit();
    }

    public function rollback()
    {
        $this->pdo->rollBack();
    }
}