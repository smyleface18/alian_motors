<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Maintenance.php';
require_once __DIR__ . '/../models/Car.php';

class MaintenanceController {

    public function save() {
        $db = (new Database())->connect();
        $maintenance = new Maintenance($db);
        $car = new Car($db);

        $data = [
            'date' => trim($_POST['date'] ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'cost' => trim($_POST['cost'] ?? ''),
            'car_plate' => trim($_POST['car_plate'] ?? ''),
        ];

        $errors = $this->validateMaintenance($data);
        if (!empty($errors)) {
            return ['errors' => $errors, 'old' => $data];
        }

        if (!$car->getByPlate($data['car_plate'])) {
            return ['errors' => ['Car plate does not exist.'], 'old' => $data];
        }

        try {
            $maintenance->create([
                ':date' => $data['date'],
                ':description' => $data['description'],
                ':cost' => $data['cost'],
                ':car_plate' => $data['car_plate'],
            ]);
        } catch (PDOException $e) {
            return ['errors' => ['Database error: could not save maintenance.'], 'old' => $data];
        }

        header('Location: ' . $_SERVER['PHP_SELF'] . '?view=maintenances');
        exit;
    }

    public function update() {
        $db = (new Database())->connect();
        $maintenance = new Maintenance($db);

        $data = [
            'id' => trim($_POST['id'] ?? ''),
            'date' => trim($_POST['date'] ?? ''),
            'description' => trim($_POST['description'] ?? ''),
            'cost' => trim($_POST['cost'] ?? ''),
        ];

        $errors = $this->validateMaintenance($data, true);
        if (!empty($errors)) {
            return ['errors' => $errors, 'old' => $data];
        }

        try {
            $maintenance->update($data['id'], [
                ':date' => $data['date'],
                ':description' => $data['description'],
                ':cost' => $data['cost'],
            ]);
        } catch (PDOException $e) {
            return ['errors' => ['Database error: could not update maintenance.'], 'old' => $data];
        }

        header('Location: ' . $_SERVER['PHP_SELF'] . '?view=maintenances');
        exit;
    }

    public function delete() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $db = (new Database())->connect();
            $maintenance = new Maintenance($db);
            $maintenance->delete($id);
        }

        header('Location: ' . $_SERVER['PHP_SELF'] . '?view=maintenances');
        exit;
    }

    public function getAll($filterBy = null, $filterValue = null) {
        $db = (new Database())->connect();
        $maintenance = new Maintenance($db);
        return $maintenance->getAll($filterBy, $filterValue);
    }

    public function getById($id) {
        $db = (new Database())->connect();
        $maintenance = new Maintenance($db);
        return $maintenance->getById($id);
    }

    public function getCars() {
        $db = (new Database())->connect();
        $car = new Car($db);
        return $car->getAllForSelect();
    }

    private function validateMaintenance(array $data, bool $isUpdate = false): array {
        $errors = [];

        if ($isUpdate && empty($data['id'])) {
            $errors[] = 'Invalid maintenance record.';
        }

        if (empty($data['date'])) {
            $errors[] = 'Date is required.';
        } elseif (!DateTime::createFromFormat('Y-m-d', $data['date'])) {
            $errors[] = 'Date must be in YYYY-MM-DD format.';
        }

        if (empty($data['description'])) {
            $errors[] = 'Description is required.';
        }

        if ($data['cost'] === '' || $data['cost'] === null) {
            $errors[] = 'Cost is required.';
        } elseif (!is_numeric($data['cost']) || $data['cost'] < 0) {
            $errors[] = 'Cost must be a valid non-negative number.';
        }

        if (isset($data['car_plate']) && empty($data['car_plate'])) {
            $errors[] = 'Car plate is required.';
        }

        return $errors;
    }
}
