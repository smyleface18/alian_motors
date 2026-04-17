<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Owner Details</h3>
    <a href="?view=owners" class="btn btn-secondary">Back to Owners</a>
</div>

<?php if (empty($owner)): ?>
    <div class="alert alert-warning">Owner not found.</div>
<?php else: ?>
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($owner['name']) ?></h5>
            <p class="card-text"><strong>CC:</strong> <?= htmlspecialchars($owner['cc']) ?></p>
            <p class="card-text"><strong>Email:</strong> <?= htmlspecialchars($owner['email']) ?></p>
            <p class="card-text"><strong>Phone:</strong> <?= htmlspecialchars($owner['phone']) ?></p>
            <a href="?view=owners&action=edit&cc=<?= urlencode($owner['cc']) ?>" class="btn btn-sm btn-outline-secondary">Edit Owner</a>
        </div>
    </div>

    <h4>Cars owned by <?= htmlspecialchars($owner['name']) ?></h4>
    <?php if (empty($cars)): ?>
        <div class="alert alert-info">No cars registered for this owner yet.</div>
    <?php else: ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>License Plate</th>
                    <th>Brand</th>
                    <th>Model</th>
                    <th>Line</th>
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
                        <td>
                            <a href="?view=cars&action=view&license_plate=<?= urlencode($car['license_plate']) ?>" class="btn btn-sm btn-outline-info">Maintenances</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
<?php endif; ?>
