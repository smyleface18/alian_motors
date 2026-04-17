<?php
require_once __DIR__ . '/../app/controllers/OwnerController.php';
require_once __DIR__ . '/../app/controllers/CarController.php';
require_once __DIR__ . '/../app/controllers/MaintenanceController.php';

$view = $_GET['view'] ?? 'owners';
$action = $_GET['action'] ?? 'index';
$filterBy = $_GET['filter_by'] ?? null;
$filterValue = $_GET['filter_value'] ?? null;
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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && in_array($action, ['save', 'update'], true)) {
    $controller->{$action}();
    exit;
}

if ($action === 'delete') {
    $controller->delete();
    exit;
}

require_once __DIR__ . '/../app/views/Layout/header.php';

switch ($view) {
    case 'owners':
        if ($action === 'create') {
            require __DIR__ . '/../app/views/owners/form.php';
        } elseif ($action === 'edit') {
            $owner = $controller->getByCc($_GET['cc'] ?? '');
            require __DIR__ . '/../app/views/owners/form.php';
        } elseif ($action === 'view') {
            $owner = $controller->getByCc($_GET['cc'] ?? '');
            $cars = $controller->getCars($_GET['cc'] ?? '');
            require __DIR__ . '/../app/views/owners/view.php';
        } else {
            $owners = $controller->getAll($filterBy, $filterValue);
            require __DIR__ . '/../app/views/owners/index.php';
        }
        break;

    case 'cars':
        $owners = $controller->getOwners();
        if ($action === 'create') {
            require __DIR__ . '/../app/views/cars/form.php';
        } elseif ($action === 'edit') {
            $car = $controller->getByPlate($_GET['license_plate'] ?? '');
            require __DIR__ . '/../app/views/cars/form.php';
        } elseif ($action === 'view') {
            $car = $controller->getByPlate($_GET['license_plate'] ?? '');
            $maintenances = $controller->getMaintenances($_GET['license_plate'] ?? '');
            require __DIR__ . '/../app/views/cars/view.php';
        } else {
            $cars = $controller->getAll($filterBy, $filterValue);
            require __DIR__ . '/../app/views/cars/index.php';
        }
        break;

    case 'maintenances':
        $cars = $controller->getCars();
        if ($action === 'create') {
            require __DIR__ . '/../app/views/maintenances/form.php';
        } elseif ($action === 'edit') {
            $maintenance = $controller->getById($_GET['id'] ?? null);
            require __DIR__ . '/../app/views/maintenances/form.php';
        } else {
            $maintenances = $controller->getAll($filterBy, $filterValue);
            require __DIR__ . '/../app/views/maintenances/index.php';
        }
        break;

    default:
        echo '<div class="alert alert-danger">View not found</div>';
        break;
}

require_once __DIR__ . '/../app/views/Layout/footer.php';
