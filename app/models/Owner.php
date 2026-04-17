<?php
require_once "Person.php";

class Owner extends Person {
    private $conn;
    private $table = "owners";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($data) {
        $sql = "INSERT INTO owners 
                (cc, name, email, phone)
                VALUES (:cc, :name, :email, :phone)";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function getAll() {
        $stmt = $this->conn->query("SELECT cc, name, email, phone FROM owners ORDER BY name");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
