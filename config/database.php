<?php

class Database {
    private $host = 'localhost'; 
    private $db_name = 'clinic_manager_db'; 
    private $username = 'root'; 
    private $password = ''; 
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Ativa o modo de erro
        } catch (PDOException $exception) {
            echo "Erro de conexão: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
