<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Car.php';
require_once __DIR__ . '/../models/Owner.php';
require_once __DIR__ . '/../models/Maintenance.php';

class CarController {

    public function save() {
        $db = (new Database())->connect();
        $car = new Car($db);
        $owner = new Owner($db);

        $data = [
            'license_plate' => trim($_POST['license_plate'] ?? ''),
            'brand' => trim($_POST['brand'] ?? ''),
            'model' => trim($_POST['model'] ?? ''),
            'line' => trim($_POST['line'] ?? ''),
            'owner_cc' => trim($_POST['owner_cc'] ?? ''),
        ];

        $errors = $this->validateCar($data, false);
        if (!empty($errors)) {
            return ['errors' => $errors, 'old' => $data];
        }

        if (!$owner->getByCc($data['owner_cc'])) {
            return ['errors' => ['Owner CC does not exist.'], 'old' => $data];
        }

        if ($car->getByPlate($data['license_plate'])) {
            return ['errors' => ['License plate already registered.'], 'old' => $data];
        }

        try {
            $car->create([
                ':license_plate' => $data['license_plate'],
                ':brand' => $data['brand'],
                ':model' => $data['model'],
                ':line' => $data['line'],
                ':owner_cc' => $data['owner_cc'],
            ]);
        } catch (PDOException $e) {
            return ['errors' => ['Database error: could not save car.'], 'old' => $data];
        }

        header('Location: ' . $_SERVER['PHP_SELF'] . '?view=cars');
        exit;
    }

    public function update() {
        $db = (new Database())->connect();
        $car = new Car($db);
        $owner = new Owner($db);

        $originalPlate = trim($_POST['original_license_plate'] ?? '');
        $data = [
            'license_plate' => $originalPlate,
            'brand' => trim($_POST['brand'] ?? ''),
            'model' => trim($_POST['model'] ?? ''),
            'line' => trim($_POST['line'] ?? ''),
            'owner_cc' => trim($_POST['owner_cc'] ?? ''),
        ];

        $errors = $this->validateCar($data, true);
        if (!empty($errors)) {
            return ['errors' => $errors, 'old' => $data];
        }

        if (!$owner->getByCc($data['owner_cc'])) {
            return ['errors' => ['Owner CC does not exist.'], 'old' => $data];
        }

        try {
            $car->update($originalPlate, [
                ':brand' => $data['brand'],
                ':model' => $data['model'],
                ':line' => $data['line'],
                ':owner_cc' => $data['owner_cc'],
            ]);
        } catch (PDOException $e) {
            return ['errors' => ['Database error: could not update car.'], 'old' => $data];
        }

        header('Location: ' . $_SERVER['PHP_SELF'] . '?view=cars');
        exit;
    }

    public function delete() {
        $licensePlate = $_GET['license_plate'] ?? null;
        if ($licensePlate) {
            $db = (new Database())->connect();
            $car = new Car($db);
            $car->delete($licensePlate);
        }

        header('Location: ' . $_SERVER['PHP_SELF'] . '?view=cars');
        exit;
    }

    public function getAll($filterBy = null, $filterValue = null) {
        $db = (new Database())->connect();
        $car = new Car($db);
        return $car->getAll($filterBy, $filterValue);
    }

    public function getByPlate($licensePlate) {
        $db = (new Database())->connect();
        $car = new Car($db);
        return $car->getByPlate($licensePlate);
    }

    public function getOwners() {
        $db = (new Database())->connect();
        $owner = new Owner($db);
        return $owner->getAll();
    }

    public function getMaintenances($licensePlate) {
        $db = (new Database())->connect();
        $maintenance = new Maintenance($db);
        return $maintenance->getByCarPlate($licensePlate);
    }

    private function validateCar(array $data, bool $isUpdate): array {
        $errors = [];

        if (empty($data['license_plate'])) {
            $errors[] = 'License plate is required.';
        } elseif (!preg_match('/^[A-Za-z0-9\-\s]{3,15}$/', $data['license_plate'])) {
            $errors[] = 'License plate must contain only letters, numbers, spaces or hyphens.';
        }

        if (empty($data['brand'])) {
            $errors[] = 'Brand is required.';
        }

        if (empty($data['model'])) {
            $errors[] = 'Model is required.';
        }

        if (empty($data['line'])) {
            $errors[] = 'Line is required.';
        }

        if (empty($data['owner_cc'])) {
            $errors[] = 'Owner CC is required.';
        } elseif (!preg_match('/^\d{4,20}$/', $data['owner_cc'])) {
            $errors[] = 'Owner CC must be numeric.';
        }

        return $errors;
    }
}
