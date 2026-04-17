<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Cars</h3>
    <a href="?view=cars&action=create" class="btn btn-success">Add Car</a>
</div>

<form class="row g-3 mb-4" method="get" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
    <input type="hidden" name="view" value="cars">
    <div class="col-md-3">
        <label class="form-label">Filter by</label>
        <select name="filter_by" class="form-select">
            <option value="license_plate" <?= ($filterBy === 'license_plate') ? 'selected' : '' ?>>License Plate</option>
            <option value="owner_cc" <?= ($filterBy === 'owner_cc') ? 'selected' : '' ?>>Owner CC</option>
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Search</label>
        <input type="search" name="filter_value" class="form-control" value="<?= htmlspecialchars($filterValue ?? '') ?>" placeholder="Search by plate or owner CC">
    </div>
    <div class="col-md-3 d-flex align-items-end">
        <button type="submit" class="btn btn-outline-primary w-100">Filter</button>
    </div>
</form>

<?php if (empty($cars)): ?>
    <div class="alert alert-info">No cars registered.</div>
<?php else: ?>
    <table class="table table-striped">
        <thead>
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
                    <td>
                        <a href="?view=cars&action=view&license_plate=<?= urlencode($car['license_plate']) ?>" class="btn btn-sm btn-outline-info">Maintenances</a>
                        <a href="?view=cars&action=edit&license_plate=<?= urlencode($car['license_plate']) ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
                        <a href="?view=cars&action=delete&license_plate=<?= urlencode($car['license_plate']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this car?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
