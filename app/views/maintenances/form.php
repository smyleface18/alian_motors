<?php
$editing = !empty($maintenance);
?>

<h3><?= $editing ? 'Edit Maintenance' : 'Register Maintenance' ?></h3>

<?php if (empty($cars)): ?>
    <div class="alert alert-warning">You need at least one car before recording maintenance.</div>
    <a href="?view=cars&action=create" class="btn btn-primary">Add Car</a>
<?php else: ?>
    <form method="post" action="?view=maintenances&action=<?= $editing ? 'update' : 'save' ?>" class="row g-3">
        <?php if ($editing): ?>
            <input type="hidden" name="id" value="<?= htmlspecialchars($maintenance['id']) ?>">
        <?php endif; ?>

        <div class="col-md-4">
            <label class="form-label">Car</label>
            <select name="car_plate" class="form-select" <?= $editing ? 'disabled' : 'required' ?>>
                <option value="">Select a car</option>
                <?php foreach ($cars as $car): ?>
                    <option value="<?= htmlspecialchars($car['license_plate']) ?>" <?= $editing && $car['license_plate'] === ($maintenance['car_plate'] ?? '') ? 'selected' : '' ?>>
                        <?= htmlspecialchars($car['license_plate'] . ' - ' . $car['brand'] . ' ' . $car['model'] . ' (' . $car['owner'] . ')') ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php if ($editing): ?>
                <input type="hidden" name="car_plate" value="<?= htmlspecialchars($maintenance['car_plate']) ?>">
            <?php endif; ?>
        </div>
        <div class="col-md-4">
            <label class="form-label">Date</label>
            <input type="date" name="date" class="form-control" required value="<?= htmlspecialchars($maintenance['date'] ?? '') ?>">
        </div>
        <div class="col-md-4">
            <label class="form-label">Cost</label>
            <input type="number" step="0.01" name="cost" class="form-control" required value="<?= htmlspecialchars($maintenance['cost'] ?? '') ?>">
        </div>
        <div class="col-12">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4" required><?= htmlspecialchars($maintenance['description'] ?? '') ?></textarea>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-success">Save</button>
            <a href="?view=maintenances" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
<?php endif; ?>
