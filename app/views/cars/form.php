<?php
$editing = !empty($car);
?>

<div class="card section-card shadow-sm">
    <div class="card-body">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-3 mb-4">
            <div>
                <h3 class="mb-1"><i class="bi bi-car-front-fill text-success me-2"></i><?= $editing ? 'Edit Car' : 'Add Car' ?></h3>
                <p class="text-muted mb-0">Register or update the vehicle and link it to an owner by CC.</p>
            </div>
            <div class="text-end">
                <a href="?view=cars" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Back</a>
            </div>
        </div>

        <?php if (empty($owners) && !$editing): ?>
            <div class="alert alert-warning">You need at least one owner before adding a car.</div>
            <a href="?view=owners&action=create" class="btn btn-primary"><i class="bi bi-person-plus"></i> Register Owner</a>
        <?php else: ?>
            <form method="post" action="?view=cars&action=<?= $editing ? 'update' : 'save' ?>" class="row g-4">
                <?php if ($editing): ?>
                    <input type="hidden" name="original_license_plate" value="<?= htmlspecialchars($car['license_plate']) ?>">
                <?php endif; ?>

                <div class="col-md-4">
                    <label class="form-label">License Plate</label>
                    <input type="text" name="license_plate" class="form-control" required value="<?= htmlspecialchars($car['license_plate'] ?? '') ?>" <?= $editing ? 'readonly' : '' ?>>
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
                    <div class="form-text">Use the owner's CC exactly as it appears in the owners list.</div>
                </div>
                <div class="col-12 d-flex gap-2 flex-column flex-sm-row">
                    <button type="submit" class="btn btn-success btn-lg"><i class="bi bi-save-fill me-1"></i> Save Car</button>
                    <a href="?view=cars" class="btn btn-outline-secondary btn-lg"><i class="bi bi-x-circle me-1"></i> Cancel</a>
                </div>
            </form>
        <?php endif; ?>
    </div>
</div>
