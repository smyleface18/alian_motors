<?php
$editing = !empty($car);
?>

<h3><?= $editing ? 'Edit Car' : 'Add Car' ?></h3>

<?php if (empty($owners) && !$editing): ?>
    <div class="alert alert-warning">You need at least one owner before adding a car.</div>
    <a href="?view=owners&action=create" class="btn btn-primary">Register Owner</a>
<?php else: ?>
    <form method="post" action="?view=cars&action=<?= $editing ? 'update' : 'save' ?>" class="row g-3">
        <?php if ($editing): ?>
            <input type="hidden" name="original_license_plate" value="<?= htmlspecialchars($car['license_plate']) ?>">
        <?php endif; ?>

        <div class="col-md-4">
            <label class="form-label">License Plate</label>
            <input type="text" name="license_plate" class="form-control" required value="<?= htmlspecialchars($car['license_plate'] ?? '') ?>" <?= $editing ? 'readonly' : '' ?> >
        </div>
        <div class="col-md-4">
            <label class="form-label">Brand</label>
            <input type="text" name="brand" class="form-control" required value="<?= htmlspecialchars($car['brand'] ?? '') ?>">
        </div>
        <div class="col-md-4">
            <label class="form-label">Model</label>
            <input type="text" name="model" class="form-control" required value="<?= htmlspecialchars($car['model'] ?? '') ?>">
        </div>
        <div class="col-md-4">
            <label class="form-label">Line</label>
            <input type="text" name="line" class="form-control" required value="<?= htmlspecialchars($car['line'] ?? '') ?>">
        </div>
        <div class="col-md-4">
            <label class="form-label">Owner CC</label>
            <input type="text" name="owner_cc" class="form-control" required value="<?= htmlspecialchars($car['owner_cc'] ?? '') ?>" placeholder="Enter owner CC">
            <div class="form-text">Use the owner's CC from the owners list.</div>
        </div>
        <div class="col-12">
            <button type="submit" class="btn btn-success">Save</button>
            <a href="?view=cars" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
<?php endif; ?>
