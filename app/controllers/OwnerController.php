<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Owner.php';

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

    public function getAll() {
        $db = (new Database())->connect();
        $owner = new Owner($db);
        return $owner->getAll();
    }
}
