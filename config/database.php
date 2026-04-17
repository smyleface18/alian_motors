<?php
class Database {
    private $host = "localhost";
    private $db = "cars_db";
    private $user = "root";
    private $pass = "";

    public function connect() {
        try {
            $conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db}",
                $this->user,
                $this->pass
            );
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch(PDOException $e) {
            die("Error DB: " . $e->getMessage());
        }
    }
}