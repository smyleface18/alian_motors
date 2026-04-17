<?php
require_once __DIR__ . '/../../config/database.php';
require_once __DIR__ . '/../models/Owner.php';
require_once __DIR__ . '/../models/Car.php';

class OwnerController {

    public function save() {
        $db = (new Database())->connect();
        $owner = new Owner($db);

        $data = [
            'cc' => trim($_POST['cc'] ?? ''),
            'name' => trim($_POST['name'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'phone' => trim($_POST['phone'] ?? ''),
        ];

        $errors = $this->validateOwner($data, false);
        if (!empty($errors)) {
            return ['errors' => $errors, 'old' => $data];
        }

        if ($owner->getByCc($data['cc'])) {
            return ['errors' => ['CC already registered.'], 'old' => $data];
        }

        try {
            $owner->create([
                ':cc' => $data['cc'],
                ':name' => $data['name'],
                ':email' => $data['email'],
                ':phone' => $data['phone'],
            ]);
        } catch (PDOException $e) {
            return ['errors' => ['Database error: could not save owner.'], 'old' => $data];
        }

        header('Location: ' . $_SERVER['PHP_SELF'] . '?view=owners');
        exit;
    }

    public function update() {
        $db = (new Database())->connect();
        $owner = new Owner($db);

        $originalCc = trim($_POST['original_cc'] ?? '');
        $data = [
            'cc' => $originalCc,
            'name' => trim($_POST['name'] ?? ''),
            'email' => trim($_POST['email'] ?? ''),
            'phone' => trim($_POST['phone'] ?? ''),
        ];

        $errors = $this->validateOwner($data, true);
        if (!empty($errors)) {
            return ['errors' => $errors, 'old' => $data];
        }

        try {
            $owner->update($originalCc, [
                ':name' => $data['name'],
                ':email' => $data['email'],
                ':phone' => $data['phone'],
            ]);
        } catch (PDOException $e) {
            return ['errors' => ['Database error: could not update owner.'], 'old' => $data];
        }

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

    private function validateOwner(array $data, bool $isUpdate): array {
        $errors = [];

        if (empty($data['cc'])) {
            $errors[] = 'CC is required.';
        } elseif (!preg_match('/^\d{4,20}$/', $data['cc'])) {
            $errors[] = 'CC must be numeric and between 4 and 20 digits.';
        }

        if (empty($data['name'])) {
            $errors[] = 'Name is required.';
        } elseif (!preg_match('/^[\p{L}\s\-\']+$/u', $data['name'])) {
            $errors[] = 'Name must contain only letters, spaces, hyphens or apostrophes.';
        }

        if (!empty($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[] = 'Email must be valid.';
        }

        if (!empty($data['phone']) && !preg_match('/^[0-9+\s\-()]{7,20}$/', $data['phone'])) {
            $errors[] = 'Phone must contain only numbers, spaces, +, -, or parentheses.';
        }

        return $errors;
    }
}
