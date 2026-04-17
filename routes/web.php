<?php
require_once __DIR__ . '/../app/controllers/OwnerController.php';
require_once __DIR__ . '/../app/controllers/CarController.php';
require_once __DIR__ . '/../app/controllers/MaintenanceController.php';

$view = $_GET['view'] ?? 'owners';
$action = $_GET['action'] ?? 'index';
$allowedViews = ['owners', 'cars', 'maintenances'];

if (!in_array($view, $allowedViews, true)) {
    $view = 'owners';
}

$controllers = [
    'owners' => new OwnerController(),
    'cars' => new CarController(),
    'maintenances' => new MaintenanceController(),
];

$controller = $controllers[$view];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $action === 'save') {
    $controller->save();
    exit;
}

require_once __DIR__ . '/../app/views/Layout/header.php';

switch ($view) {
    case 'owners':
        if ($action === 'create') {
            require __DIR__ . '/../app/views/owners/form.php';
        } else {
            $owners = $controller->getAll();
            require __DIR__ . '/../app/views/owners/index.php';
        }
        break;

    case 'cars':
        $owners = $controller->getOwners();
        if ($action === 'create') {
            require __DIR__ . '/../app/views/cars/form.php';
        } else {
            $cars = $controller->getAll();
            require __DIR__ . '/../app/views/cars/index.php';
        }
        break;

    case 'maintenances':
        $cars = $controller->getCars();
        if ($action === 'create') {
            require __DIR__ . '/../app/views/maintenances/form.php';
        } else {
            $maintenances = $controller->getAll();
            require __DIR__ . '/../app/views/maintenances/index.php';
        }
        break;

    default:
        echo '<div class="alert alert-danger">View not found</div>';
        break;
}

require_once __DIR__ . '/../app/views/Layout/footer.php';
