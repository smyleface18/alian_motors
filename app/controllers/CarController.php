<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Car.php';
require_once __DIR__ . '/../models/Owner.php';
require_once __DIR__ . '/../models/Maintenance.php';

class CarController {

    public function save() {
        $db = (new Database())->connect();
        $car = new Car($db);

        $car->create([
            ':license_plate' => $_POST['license_plate'],
            ':brand' => $_POST['brand'],
            ':model' => $_POST['model'],
            ':line' => $_POST['line'],
            ':owner_cc' => $_POST['owner_cc']
        ]);

        header('Location: ' . $_SERVER['PHP_SELF'] . '?view=cars');
        exit;
    }

    public function update() {
        $db = (new Database())->connect();
        $car = new Car($db);

        $car->update($_POST['original_license_plate'], [
            ':brand' => $_POST['brand'],
            ':model' => $_POST['model'],
            ':line' => $_POST['line'],
            ':owner_cc' => $_POST['owner_cc']
        ]);

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
}
