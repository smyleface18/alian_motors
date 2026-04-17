<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Car.php';
require_once __DIR__ . '/../models/Owner.php';

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

    public function getAll() {
        $db = (new Database())->connect();
        $car = new Car($db);
        return $car->getAll();
    }

    public function getOwners() {
        $db = (new Database())->connect();
        $owner = new Owner($db);
        return $owner->getAll();
    }
}
