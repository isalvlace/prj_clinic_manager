<?php
class ArquivoModel
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    public function getArquivos()
    {
        $query = "SELECT id, usuario_id, nome, caminho, criado_em FROM arquivo";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function salvarArquivo($usuarioId, $nome, $caminho)
    {
        $query = "INSERT INTO arquivo (usuario_id, nome, caminho, criado_em) 
                  VALUES (:usuario_id, :nome_arquivo, :caminho, NOW())";
        $stmt = $this->db->prepare($query);
        return $stmt->execute([
            ':usuario_id' => $usuarioId,
            ':nome_arquivo' => $nome,
            ':caminho' => $caminho,
        ]);
    }

    public function beginTransaction()
    {
        $this->db->beginTransaction();
    }

    public function commit()
    {
        $this->db->commit();
    }

    public function rollback()
    {
        $this->db->rollBack();
    }
}