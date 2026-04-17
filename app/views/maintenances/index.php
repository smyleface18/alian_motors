<div class="card section-card shadow-sm mb-4">
    <div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-start gap-3">
        <div>
            <h3 class="mb-1"><i class="bi bi-tools text-warning me-2"></i>Maintenances</h3>
            <p class="text-muted mb-0">Filtra los registros por placa, fecha, dueño, marca, modelo, línea o descripción del servicio.</p>
        </div>
        <a href="?view=maintenances&action=create" class="btn btn-warning btn-lg">
            <i class="bi bi-plus-lg"></i> Register Maintenance
        </a>
    </div>
</div>

<form class="card section-card shadow-sm mb-4 p-4" method="get" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
    <input type="hidden" name="view" value="maintenances">
    <div class="row gy-3 align-items-end">
        <div class="col-md-3">
            <label class="form-label">Filter by</label>
            <select name="filter_by" class="form-select">
                <option value="all" <?= ($filterBy === 'all') ? 'selected' : '' ?>>All fields</option>
                <option value="car_plate" <?= ($filterBy === 'car_plate') ? 'selected' : '' ?>>Car Plate</option>
                <option value="date" <?= ($filterBy === 'date') ? 'selected' : '' ?>>Date</option>
                <option value="owner" <?= ($filterBy === 'owner') ? 'selected' : '' ?>>Owner</option>
                <option value="brand" <?= ($filterBy === 'brand') ? 'selected' : '' ?>>Brand</option>
                <option value="model" <?= ($filterBy === 'model') ? 'selected' : '' ?>>Model</option>
                <option value="line" <?= ($filterBy === 'line') ? 'selected' : '' ?>>Line</option>
                <option value="description" <?= ($filterBy === 'description') ? 'selected' : '' ?>>Description</option>
            </select>
        </div>
        <div class="col-md-7">
            <label class="form-label">Search</label>
            <input type="search" name="filter_value" class="form-control" value="<?= htmlspecialchars($filterValue ?? '') ?>" placeholder="Enter a term to filter maintenance records">
        </div>
        <div class="col-md-2 d-grid">
            <button type="submit" class="btn btn-primary btn-lg"><i class="bi bi-funnel-fill me-1"></i> Filter</button>
        </div>
    </div>
</form>

<?php if (empty($maintenances)): ?>
    <div class="alert alert-info rounded-4 shadow-sm">No maintenance records found.</div>
<?php else: ?>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Showing <?= count($maintenances) ?> maintenance records.</span>
        <span class="badge bg-warning text-dark">Better filtering</span>
    </div>
    <div class="card section-card shadow-sm overflow-auto">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>Date</th>
                    <th>Car</th>
                    <th>Owner</th>
                    <th>Description</th>
                    <th>Cost</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($maintenances as $maintenance): ?>
                    <tr>
                        <td><?= htmlspecialchars($maintenance['date']) ?></td>
                        <td><?= htmlspecialchars($maintenance['license_plate'] . ' - ' . $maintenance['brand'] . ' ' . $maintenance['model']) ?></td>
                        <td><?= htmlspecialchars($maintenance['owner']) ?></td>
                        <td><?= nl2br(htmlspecialchars($maintenance['description'])) ?></td>
                        <td>$<?= htmlspecialchars(number_format($maintenance['cost'], 2)) ?></td>
                        <td class="text-nowrap">
                            <a href="?view=maintenances&action=edit&id=<?= urlencode($maintenance['id']) ?>" class="btn btn-sm btn-outline-secondary me-1"><i class="bi bi-pencil-square"></i></a>
                            <a href="?view=maintenances&action=delete&id=<?= urlencode($maintenance['id']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this maintenance record?');"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>
