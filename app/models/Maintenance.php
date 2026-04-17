<?php
class Maintenance {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create($data) {
        $sql = "INSERT INTO maintenances
                (`date`, description, cost, car_plate)
                VALUES (:date, :description, :cost, :car_plate)";

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function getAll() {
        $sql = "SELECT m.id, m.`date`, m.description, m.cost, c.license_plate, c.brand, c.model, o.name AS owner
                FROM maintenances m
                JOIN cars c ON m.car_plate = c.license_plate
                JOIN owners o ON c.owner_cc = o.cc
                ORDER BY m.`date` DESC";

        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
