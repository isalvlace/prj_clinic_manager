<?php
class ArquivoModel {
    private $db;

    public function __construct($database) {
        $this->db = $database;
    }

    public function getArquivos() {
        $query = "SELECT id, usuario_id, nome_arquivo, caminho, criado_em FROM arquivo";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
