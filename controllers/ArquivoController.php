<?php
require_once 'models/Arquivo.php';

class ArquivoController {
    private $arquivoModel;

    public function __construct($pdo) {
        $this->arquivoModel = new ArquivoModel($pdo);
    }

    public function listarArquivos() {
        $arquivos = $this->arquivoModel->getArquivos();
        require 'views/components/table.php'; 
    }
}