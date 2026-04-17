<h3>Register Maintenance</h3>

<?php if (empty($cars)): ?>
    <div class="alert alert-warning">You need at least one car before recording maintenance.</div>
    <a href="?view=cars&action=create" class="btn btn-primary">Add Car</a>
<?php else: ?>
    <form method="post" action="?view=maintenances&action=save" class="row g-3">
        <div class="col-md-4">
            <label class="form-label">Car</label>
            <select name="car_plate" class="form-select" required>
                <option value="">Select a car</option>
                <?php foreach ($cars as $car): ?>
                    <option value="<?= htmlspecialchars($car['license_plate']) ?>">
                        <?= htmlspecialchars($car['license_plate'] . ' - ' . $car['brand'] . ' ' . $car['model'] . ' (' . $car['owner'] . ')') ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label">Date</label>
            <input type="date" name="date" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Cost</label>
            <input type="number" step="0.01" name="cost" class="form-control" required>
        </div>
        <div class="col-12">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4" required></textarea>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-success">Save</button>
            <a href="?view=maintenances" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
<?php endif; ?>
