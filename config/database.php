<?php

class Database {
    private $host = 'db'; 
    private $db_name = 'clinica'; 
    private $username = 'user_admin'; 
    private $password = 'password123'; 
    public $conn;

    public function getConnection() {
    $this->conn = null;
    $attempts = 0;
    $maxAttempts = 5;

    while ($attempts < $maxAttempts) {
        try {
            $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn; // Conectou! Sai do loop.
        } catch (PDOException $exception) {
            $attempts++;
            if ($attempts >= $maxAttempts) {
                echo "Erro de conexão após $maxAttempts tentativas: " . $exception->getMessage();
                return null;
            }
            sleep(2);  
        }
    }
}
}
