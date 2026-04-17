<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Maintenance.php';
require_once __DIR__ . '/../models/Car.php';

class MaintenanceController {

    public function save() {
        $db = (new Database())->connect();
        $maintenance = new Maintenance($db);

        $maintenance->create([
            ':date' => $_POST['date'],
            ':description' => $_POST['description'],
            ':cost' => $_POST['cost'],
            ':car_plate' => $_POST['car_plate'],
        ]);

        header('Location: ' . $_SERVER['PHP_SELF'] . '?view=maintenances');
        exit;
    }

    public function update() {
        $db = (new Database())->connect();
        $maintenance = new Maintenance($db);

        $maintenance->update($_POST['id'], [
            ':date' => $_POST['date'],
            ':description' => $_POST['description'],
            ':cost' => $_POST['cost']
        ]);

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
}
