<div class="card section-card shadow-sm mb-4">
    <div class="card-body">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-3 mb-4">
            <div>
                <h3 class="mb-1"><i class="bi bi-car-front text-success me-2"></i>Car Details</h3>
                <p class="text-muted mb-0">Revisa el vehículo y su historial de mantenimiento en un solo lugar.</p>
            </div>
            <div class="text-end">
                <a href="?view=cars" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Back to Cars</a>
            </div>
        </div>

        <?php if (empty($car)): ?>
            <div class="alert alert-warning">Car not found.</div>
        <?php else: ?>
            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <div class="p-4 bg-light rounded-4">
                        <h5 class="mb-3"><i class="bi bi-card-list text-success me-2"></i><?= htmlspecialchars($car['license_plate']) ?></h5>
                        <p class="mb-2"><strong>Brand:</strong> <?= htmlspecialchars($car['brand']) ?></p>
                        <p class="mb-2"><strong>Model:</strong> <?= htmlspecialchars($car['model']) ?></p>
                        <p class="mb-2"><strong>Line:</strong> <?= htmlspecialchars($car['line']) ?></p>
                        <p class="mb-2"><strong>Owner:</strong> <?= htmlspecialchars($car['owner'] . ' (' . $car['owner_cc'] . ')') ?></p>
                        <a href="?view=cars&action=edit&license_plate=<?= urlencode($car['license_plate']) ?>" class="btn btn-sm btn-outline-secondary mt-3"><i class="bi bi-pencil-square"></i> Edit Car</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4 bg-white rounded-4 border h-100">
                        <h5 class="mb-3"><i class="bi bi-tools text-warning me-2"></i>Maintenance summary</h5>
                        <p class="text-muted">Keeps track of the last maintenance events for this car.</p>
                        <span class="badge bg-success">Current owner: <?= htmlspecialchars($car['owner']) ?></span>
                    </div>
                </div>
            </div>

            <div class="card section-card shadow-sm overflow-auto">
                <div class="card-body">
                    <h5 class="mb-3"><i class="bi bi-clock-history text-secondary me-2"></i>Maintenance History</h5>
                    <?php if (empty($maintenances)): ?>
                        <div class="alert alert-info">No maintenance history for this car.</div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
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
                                                <a href="?view=maintenances&action=edit&id=<?= urlencode($maintenance['id']) ?>" class="btn btn-sm btn-outline-secondary"><i class="bi bi-pencil-square"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
