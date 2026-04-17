<h3>Add Car</h3>

<?php if (empty($owners)): ?>
    <div class="alert alert-warning">You need at least one owner before adding a car.</div>
    <a href="?view=owners&action=create" class="btn btn-primary">Register Owner</a>
<?php else: ?>
    <form method="post" action="?view=cars&action=save" class="row g-3">
        <div class="col-md-4">
            <label class="form-label">License Plate</label>
            <input type="text" name="license_plate" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Brand</label>
            <input type="text" name="brand" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Model</label>
            <input type="text" name="model" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Line</label>
            <input type="text" name="line" class="form-control" required>
        </div>
        <div class="col-md-4">
            <label class="form-label">Owner</label>
            <select name="owner_cc" class="form-select" required>
                <option value="">Select an owner</option>
                <?php foreach ($owners as $owner): ?>
                    <option value="<?= htmlspecialchars($owner['cc']) ?>">
                        <?= htmlspecialchars($owner['name'] . ' (' . $owner['cc'] . ')') ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-success">Save</button>
            <a href="?view=cars" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
<?php endif; ?>
