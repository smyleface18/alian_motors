<?php
class Car {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($data) {
        $sql = "INSERT INTO cars 
                (license_plate, brand, model, `line`, owner_cc)
                VALUES (:license_plate, :brand, :model, :line, :owner_cc)";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function getAll() {
        $sql = "SELECT c.license_plate, c.brand, c.model, c.`line`, o.name AS owner
                FROM cars c
                JOIN owners o ON c.owner_cc = o.cc
                ORDER BY c.license_plate";

        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllForSelect() {
        $sql = "SELECT c.license_plate, c.brand, c.model, o.name AS owner
                FROM cars c
                JOIN owners o ON c.owner_cc = o.cc
                ORDER BY c.license_plate";

        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
