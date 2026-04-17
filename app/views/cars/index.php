<div class="card section-card shadow-sm mb-4">
    <div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-start gap-3">
        <div>
            <h3 class="mb-1"><i class="bi bi-car-front-fill text-success me-2"></i>Cars</h3>
            <p class="text-muted mb-0">Filtra los vehículos por placa, marca, modelo, línea, propietario o CC del propietario.</p>
        </div>
        <a href="?view=cars&action=create" class="btn btn-success btn-lg">
            <i class="bi bi-plus-lg"></i> Add Car
        </a>
    </div>
</div>

<form class="card section-card shadow-sm mb-4 p-4" method="get" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
    <input type="hidden" name="view" value="cars">
    <div class="row gy-3 align-items-end">
        <div class="col-md-3">
            <label class="form-label">Filter by</label>
            <select name="filter_by" class="form-select">
                <option value="all" <?= ($filterBy === 'all') ? 'selected' : '' ?>>All fields</option>
                <option value="license_plate" <?= ($filterBy === 'license_plate') ? 'selected' : '' ?>>License Plate</option>
                <option value="brand" <?= ($filterBy === 'brand') ? 'selected' : '' ?>>Brand</option>
                <option value="model" <?= ($filterBy === 'model') ? 'selected' : '' ?>>Model</option>
                <option value="line" <?= ($filterBy === 'line') ? 'selected' : '' ?>>Line</option>
                <option value="owner" <?= ($filterBy === 'owner') ? 'selected' : '' ?>>Owner Name</option>
                <option value="owner_cc" <?= ($filterBy === 'owner_cc') ? 'selected' : '' ?>>Owner CC</option>
            </select>
        </div>
        <div class="col-md-7">
            <label class="form-label">Search</label>
            <input type="search" name="filter_value" class="form-control" value="<?= htmlspecialchars($filterValue ?? '') ?>" placeholder="Enter search term for cars">
        </div>
        <div class="col-md-2 d-grid">
            <button type="submit" class="btn btn-primary btn-lg"><i class="bi bi-funnel-fill me-1"></i> Filter</button>
        </div>
    </div>
</form>

<?php if (empty($cars)): ?>
    <div class="alert alert-info rounded-4 shadow-sm">No cars registered.</div>
<?php else: ?>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Showing <?= count($cars) ?> car<?= count($cars) === 1 ? '' : 's' ?>.</span>
        <span class="badge bg-success">Clean and fast filtering</span>
    </div>
    <div class="card section-card shadow-sm overflow-auto">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>License Plate</th>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Line</th>
                    <th>Owner</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cars as $car): ?>
                    <tr>
                        <td><?= htmlspecialchars($car['license_plate']) ?></td>
                        <td><?= htmlspecialchars($car['brand']) ?></td>
                        <td><?= htmlspecialchars($car['model']) ?></td>
                        <td><?= htmlspecialchars($car['line']) ?></td>
                        <td><?= htmlspecialchars($car['owner'] . ' (' . $car['owner_cc'] . ')') ?></td>
                        <td class="text-nowrap">
                            <a href="?view=cars&action=view&license_plate=<?= urlencode($car['license_plate']) ?>" class="btn btn-sm btn-outline-info me-1"><i class="bi bi-list-ul"></i></a>
                            <a href="?view=cars&action=edit&license_plate=<?= urlencode($car['license_plate']) ?>" class="btn btn-sm btn-outline-secondary me-1"><i class="bi bi-pencil-square"></i></a>
                            <a href="?view=cars&action=delete&license_plate=<?= urlencode($car['license_plate']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this car?');"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>
