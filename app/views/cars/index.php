<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Cars</h3>
    <a href="?view=cars&action=create" class="btn btn-success">Add Car</a>
</div>

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
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cars as $car): ?>
                <tr>
                    <td><?= htmlspecialchars($car['license_plate']) ?></td>
                    <td><?= htmlspecialchars($car['brand']) ?></td>
                    <td><?= htmlspecialchars($car['model']) ?></td>
                    <td><?= htmlspecialchars($car['line']) ?></td>
                    <td><?= htmlspecialchars($car['owner']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
