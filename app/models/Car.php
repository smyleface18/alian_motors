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

    public function getAll($filterBy = null, $filterValue = null) {
        $allowed = ['license_plate', 'owner_cc'];
        $sql = "SELECT c.license_plate, c.brand, c.model, c.`line`, o.name AS owner, c.owner_cc
                FROM cars c
                JOIN owners o ON c.owner_cc = o.cc";

        if ($filterBy && in_array($filterBy, $allowed, true) && $filterValue !== null && $filterValue !== '') {
            $sql .= " WHERE c.{$filterBy} LIKE :value";
            $sql .= " ORDER BY c.license_plate";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':value' => "%{$filterValue}%"]);
        } else {
            $sql .= " ORDER BY c.license_plate";
            $stmt = $this->conn->query($sql);
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByPlate($licensePlate) {
        $sql = "SELECT c.license_plate, c.brand, c.model, c.`line`, c.owner_cc, o.name AS owner
                FROM cars c
                JOIN owners o ON c.owner_cc = o.cc
                WHERE c.license_plate = :license_plate";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':license_plate' => $licensePlate]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByOwner($ownerCc) {
        $sql = "SELECT c.license_plate, c.brand, c.model, c.`line`, o.name AS owner
                FROM cars c
                JOIN owners o ON c.owner_cc = o.cc
                WHERE c.owner_cc = :owner_cc
                ORDER BY c.license_plate";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':owner_cc' => $ownerCc]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($originalLicensePlate, $data) {
        $sql = "UPDATE cars SET brand = :brand, model = :model, `line` = :line, owner_cc = :owner_cc
                WHERE license_plate = :license_plate";
        $stmt = $this->conn->prepare($sql);
        $data[':license_plate'] = $originalLicensePlate;
        return $stmt->execute($data);
    }

    public function delete($licensePlate) {
        $stmt = $this->conn->prepare("DELETE FROM cars WHERE license_plate = :license_plate");
        return $stmt->execute([':license_plate' => $licensePlate]);
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

