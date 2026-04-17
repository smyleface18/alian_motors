<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Owner.php';
require_once __DIR__ . '/../models/Car.php';

class OwnerController {

    public function save() {
        $db = (new Database())->connect();
        $owner = new Owner($db);

        $owner->create([
            ':cc' => $_POST['cc'],
            ':name' => $_POST['name'],
            ':email' => $_POST['email'],
            ':phone' => $_POST['phone']
        ]);

        header('Location: ' . $_SERVER['PHP_SELF'] . '?view=owners');
        exit;
    }

    public function update() {
        $db = (new Database())->connect();
        $owner = new Owner($db);

        $owner->update($_POST['original_cc'], [
            ':name' => $_POST['name'],
            ':email' => $_POST['email'],
            ':phone' => $_POST['phone']
        ]);

        header('Location: ' . $_SERVER['PHP_SELF'] . '?view=owners');
        exit;
    }

    public function delete() {
        $cc = $_GET['cc'] ?? null;
        if ($cc) {
            $db = (new Database())->connect();
            $owner = new Owner($db);
            $owner->delete($cc);
        }

        header('Location: ' . $_SERVER['PHP_SELF'] . '?view=owners');
        exit;
    }

    public function getAll($filterBy = null, $filterValue = null) {
        $db = (new Database())->connect();
        $owner = new Owner($db);
        return $owner->getAll($filterBy, $filterValue);
    }

    public function getByCc($cc) {
        $db = (new Database())->connect();
        $owner = new Owner($db);
        return $owner->getByCc($cc);
    }

    public function getCars($cc) {
        $db = (new Database())->connect();
        $car = new Car($db);
        return $car->getByOwner($cc);
    }
}
