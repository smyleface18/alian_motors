<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Maintenances</h3>
    <a href="?view=maintenances&action=create" class="btn btn-warning">Register Maintenance</a>
</div>

<form class="row g-3 mb-4" method="get" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
    <input type="hidden" name="view" value="maintenances">
    <div class="col-md-3">
        <label class="form-label">Filter by</label>
        <select name="filter_by" class="form-select">
            <option value="car_plate" <?= ($filterBy === 'car_plate') ? 'selected' : '' ?>>Car Plate</option>
            <option value="date" <?= ($filterBy === 'date') ? 'selected' : '' ?>>Date</option>
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Search</label>
        <input type="search" name="filter_value" class="form-control" value="<?= htmlspecialchars($filterValue ?? '') ?>" placeholder="Search by car plate or date">
    </div>
    <div class="col-md-3 d-flex align-items-end">
        <button type="submit" class="btn btn-outline-primary w-100">Filter</button>
    </div>
</form>

<?php if (empty($maintenances)): ?>
    <div class="alert alert-info">No maintenance records found.</div>
<?php else: ?>
    <table class="table table-striped">
        <thead>
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
                    <td>
                        <a href="?view=maintenances&action=edit&id=<?= urlencode($maintenance['id']) ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
                        <a href="?view=maintenances&action=delete&id=<?= urlencode($maintenance['id']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this maintenance record?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
