<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Car Details</h3>
    <a href="?view=cars" class="btn btn-secondary">Back to Cars</a>
</div>

<?php if (empty($car)): ?>
    <div class="alert alert-warning">Car not found.</div>
<?php else: ?>
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($car['license_plate']) ?></h5>
            <p class="card-text"><strong>Brand:</strong> <?= htmlspecialchars($car['brand']) ?></p>
            <p class="card-text"><strong>Model:</strong> <?= htmlspecialchars($car['model']) ?></p>
            <p class="card-text"><strong>Line:</strong> <?= htmlspecialchars($car['line']) ?></p>
            <p class="card-text"><strong>Owner:</strong> <?= htmlspecialchars($car['owner'] . ' (' . $car['owner_cc'] . ')') ?></p>
            <a href="?view=cars&action=edit&license_plate=<?= urlencode($car['license_plate']) ?>" class="btn btn-sm btn-outline-secondary">Edit Car</a>
        </div>
    </div>

    <h4>Maintenance history for <?= htmlspecialchars($car['license_plate']) ?></h4>

    <?php if (empty($maintenances)): ?>
        <div class="alert alert-info">No maintenance history for this car.</div>
    <?php else: ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Description</th>
                    <th>Cost</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($maintenances as $maintenance): ?>
                    <tr>
                        <td><?= htmlspecialchars($maintenance['date']) ?></td>
                        <td><?= nl2br(htmlspecialchars($maintenance['description'])) ?></td>
                        <td>$<?= htmlspecialchars(number_format($maintenance['cost'], 2)) ?></td>
                        <td>
                            <a href="?view=maintenances&action=edit&id=<?= urlencode($maintenance['id']) ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
<?php endif; ?>
