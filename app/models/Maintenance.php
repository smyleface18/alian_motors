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

    public function getAll($filterBy = null, $filterValue = null) {
        $allowed = ['car_plate', 'date'];
        $sql = "SELECT m.id, m.`date`, m.description, m.cost, c.license_plate, c.brand, c.model, o.name AS owner
                FROM maintenances m
                JOIN cars c ON m.car_plate = c.license_plate
                JOIN owners o ON c.owner_cc = o.cc";

        if ($filterBy && in_array($filterBy, $allowed, true) && $filterValue !== null && $filterValue !== '') {
            $sql .= " WHERE m.{$filterBy} LIKE :value";
            $sql .= " ORDER BY m.`date` DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':value' => "%{$filterValue}%"]);
        } else {
            $sql .= " ORDER BY m.`date` DESC";
            $stmt = $this->conn->query($sql);
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByCarPlate($licensePlate) {
        $sql = "SELECT m.id, m.`date`, m.description, m.cost, c.license_plate, c.brand, c.model, o.name AS owner
                FROM maintenances m
                JOIN cars c ON m.car_plate = c.license_plate
                JOIN owners o ON c.owner_cc = o.cc
                WHERE m.car_plate = :car_plate
                ORDER BY m.`date` DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':car_plate' => $licensePlate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT id, `date`, description, cost, car_plate FROM maintenances WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $data) {
        $sql = "UPDATE maintenances SET `date` = :date, description = :description, cost = :cost WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $data[':id'] = $id;
        return $stmt->execute($data);
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM maintenances WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}

