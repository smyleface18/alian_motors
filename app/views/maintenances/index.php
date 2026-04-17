<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Maintenances</h3>
    <a href="?view=maintenances&action=create" class="btn btn-warning">Register Maintenance</a>
</div>

<?php if (empty($maintenances)): ?>
    <div class="alert alert-info">No maintenance records found.</div>
<?php else: ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Date</th>
                <th>Car</th>
                <th>Owner</th>
                <th>Description</th>
                <th>Cost</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($maintenances as $maintenance): ?>
                <tr>
                    <td><?= htmlspecialchars($maintenance['date']) ?></td>
                    <td><?= htmlspecialchars($maintenance['license_plate'] . ' - ' . $maintenance['brand'] . ' ' . $maintenance['model']) ?></td>
                    <td><?= htmlspecialchars($maintenance['owner']) ?></td>
                    <td><?= nl2br(htmlspecialchars($maintenance['description'])) ?></td>
                    <td>$<?= htmlspecialchars(number_format($maintenance['cost'], 2)) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
