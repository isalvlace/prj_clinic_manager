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

    public function salvarArquivo() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_FILES['arquivo'])) {
            return $this->responderErro("Requisição inválida ou nenhum arquivo enviado.");
        }
    
        if (!isset($_SESSION['usuario_id'])) {
            return $this->responderErro("Usuário não autenticado.");
        }
    
        $usuarioId = $_SESSION['usuario_id'];
        $arquivo = $_FILES['arquivo'];
        $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'pdf'];
        $tamanhoMaximo = 2 * 1024 * 1024; // 2MB
    
        $extensao = strtolower(pathinfo($arquivo["name"], PATHINFO_EXTENSION));
    
        if ($arquivo["size"] > $tamanhoMaximo) {
            return $this->responderErro("Arquivo muito grande (máx. 2MB).");
        }
    
        if (!in_array($extensao, $extensoesPermitidas)) {
            return $this->responderErro("Tipo de arquivo não permitido.");
        }
    
        $info = pathinfo($arquivo["name"]);
        $nomeArquivo = $info['filename'] . "_" . date("H_i_s") . "." . $extensao;
    
        $ftpHost = '127.0.0.1';
        $ftpUser = 'ftpuser';
        $ftpPass = 'lickitup';
    
        $ftpConn = ftp_connect($ftpHost);
        if (!$ftpConn) {
            return $this->responderErro("Erro de conexão com o servidor FTP.");
        }
    
        if (!ftp_login($ftpConn, $ftpUser, $ftpPass)) {
            ftp_close($ftpConn);
            return $this->responderErro("Erro de autenticação no servidor FTP.");
        }
    
        $diretorioUpload = '/files/';
    
        $this->arquivoModel->beginTransaction();
        try {
            if (!$this->arquivoModel->salvarArquivo($usuarioId, $nomeArquivo, $diretorioUpload . $nomeArquivo)) {
                throw new Exception("Erro ao salvar no banco de dados.");
            }
    
            if (!ftp_put($ftpConn, $diretorioUpload . $nomeArquivo, $arquivo["tmp_name"], FTP_BINARY)) {
                throw new Exception("Erro ao enviar o arquivo para o servidor FTP.");
            }
    
            $this->arquivoModel->commit();
            ftp_close($ftpConn);
    
            return $this->responderSucesso("Arquivo salvo com sucesso!", ["file" => $nomeArquivo]);
    
        } catch (Exception $e) {
            $this->arquivoModel->rollback();
            ftp_close($ftpConn);
            return $this->responderErro($e->getMessage());
        }
    }
    
    private function responderErro($message) {
        header('Content-Type: application/json');
        echo json_encode(["status" => "error", "message" => $message]);
        exit();
    }
    
    private function responderSucesso($message, $data = []) {
        header('Content-Type: application/json');
        echo json_encode(array_merge(["status" => "success", "message" => $message], $data));
        exit();
    }
}