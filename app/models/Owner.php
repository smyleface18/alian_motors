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

    public function getAll($filterBy = null, $filterValue = null) {
        $allowed = ['cc', 'name'];
        $sql = "SELECT cc, name, email, phone FROM owners";

        if ($filterBy && in_array($filterBy, $allowed, true) && $filterValue !== null && $filterValue !== '') {
            $sql .= " WHERE {$filterBy} LIKE :value";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([':value' => "%{$filterValue}%"]);
        } else {
            $stmt = $this->conn->query($sql);
        }

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByCc($cc) {
        $stmt = $this->conn->prepare("SELECT cc, name, email, phone FROM owners WHERE cc = :cc");
        $stmt->execute([':cc' => $cc]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($originalCc, $data) {
        $sql = "UPDATE owners SET name = :name, email = :email, phone = :phone WHERE cc = :cc";
        $stmt = $this->conn->prepare($sql);
        $data[':cc'] = $originalCc;
        return $stmt->execute($data);
    }

    public function delete($cc) {
        $stmt = $this->conn->prepare("DELETE FROM owners WHERE cc = :cc");
        return $stmt->execute([':cc' => $cc]);
    }
}
