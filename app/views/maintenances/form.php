<?php
$editing = !empty($maintenance);
?>

<div class="card section-card shadow-sm">
    <div class="card-body">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-3 mb-4">
            <div>
                <h3 class="mb-1"><i class="bi bi-wrench-adjustable-circle text-warning me-2"></i><?= $editing ? 'Edit Maintenance' : 'Register Maintenance' ?></h3>
                <p class="text-muted mb-0">Add or update maintenance records with the associated car and cost details.</p>
            </div>
            <div class="text-end">
                <a href="?view=maintenances" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Back to Maintenances</a>
            </div>
        </div>

        <?php if (empty($cars)): ?>
            <div class="alert alert-warning">You need at least one car before recording maintenance.</div>
            <a href="?view=cars&action=create" class="btn btn-primary"><i class="bi bi-car-front-fill"></i> Add Car</a>
        <?php else: ?>
            <form method="post" action="?view=maintenances&action=<?= $editing ? 'update' : 'save' ?>" class="row g-4">
                <?php if ($editing): ?>
                    <input type="hidden" name="id" value="<?= htmlspecialchars($maintenance['id']) ?>">
                <?php endif; ?>

                <div class="col-md-4">
                    <label class="form-label">Car</label>
                    <select name="car_plate" class="form-select" <?= $editing ? 'disabled' : 'required' ?>>
                        <option value="">Select a car</option>
                        <?php foreach ($cars as $car): ?>
                            <option value="<?= htmlspecialchars($car['license_plate']) ?>" <?= $editing && $car['license_plate'] === ($maintenance['car_plate'] ?? '') ? 'selected' : '' ?> >
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
                    <div class="input-group">
                        <span class="input-group-text">$</span>
                        <input type="number" step="0.01" name="cost" class="form-control" required value="<?= htmlspecialchars($maintenance['cost'] ?? '') ?>">
                    </div>
                </div>
                <div class="col-12">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="4" required><?= htmlspecialchars($maintenance['description'] ?? '') ?></textarea>
                </div>
                <div class="col-12 d-flex gap-2 flex-column flex-sm-row">
                    <button type="submit" class="btn btn-success btn-lg"><i class="bi bi-save-fill me-1"></i> Save Maintenance</button>
                    <a href="?view=maintenances" class="btn btn-outline-secondary btn-lg"><i class="bi bi-x-circle me-1"></i> Cancel</a>
                </div>
            </form>
        <?php endif; ?>
    </div>
</div>
