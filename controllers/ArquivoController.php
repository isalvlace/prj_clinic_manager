<?php
require_once 'models/ArquivoModel.php';

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
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || empty($_FILES['arquivo']) || !isset($_SESSION['usuario_id'])) {
            return $this->responderErro("Requisição inválida ou usuário não autenticado.");
        }

        $arquivo = $_FILES['arquivo'];
        $extensao = strtolower(pathinfo($arquivo["name"], PATHINFO_EXTENSION));
        $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'pdf', 'txt'];

        if ($arquivo["size"] > 2 * 1024 * 1024) {
            return $this->responderErro("Arquivo muito grande (máx. 2MB).");
        }

        if (!in_array($extensao, $extensoesPermitidas)) {
            return $this->responderErro("Tipo de arquivo não permitido.");
        }

        $nomeArquivo = pathinfo($arquivo["name"], PATHINFO_FILENAME) . "_" . date("H_i_s") . "." . $extensao;
        $ftpPath = "/" . $nomeArquivo;

        $ftp = ftp_connect('127.0.0.1');
        if (!$ftp || !ftp_login($ftp, 'ftpuser', 'lickitup')) {
            if ($ftp) ftp_close($ftp);
            return $this->responderErro("Erro ao conectar ou autenticar no servidor FTP.");
        }

        ftp_pasv($ftp, true);  // ativa modo passivo

        $this->arquivoModel->beginTransaction();

        try {
            if (!file_exists($arquivo["tmp_name"])) {
                throw new Exception("Arquivo temporário não existe: " . $arquivo["tmp_name"]);
            }

            if (!ftp_put($ftp, $ftpPath, $arquivo["tmp_name"], FTP_BINARY)) {
                throw new Exception("Erro ao enviar o arquivo para o servidor FTP.");
            }

            if (!$this->arquivoModel->salvarArquivo($_SESSION['usuario_id'], $nomeArquivo, $ftpPath)) {
                throw new Exception("Erro ao salvar o arquivo no banco de dados.");
            }

            $this->arquivoModel->commit();
            ftp_close($ftp);
            return $this->responderSucesso("Arquivo salvo com sucesso!", ["file" => $nomeArquivo]);

        } catch (Exception $e) {
            $this->arquivoModel->rollback();
            @ftp_delete($ftp, $ftpPath);
            ftp_close($ftp);
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