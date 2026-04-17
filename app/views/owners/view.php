<div class="card section-card shadow-sm mb-4">
    <div class="card-body">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-start gap-3 mb-4">
            <div>
                <h3 class="mb-1"><i class="bi bi-person-badge-fill text-primary me-2"></i>Owner Details</h3>
                <p class="text-muted mb-0">Información completa del propietario y sus automóviles registrados.</p>
            </div>
            <div class="text-end">
                <a href="?view=owners" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Back to Owners</a>
            </div>
        </div>

        <?php if (empty($owner)): ?>
            <div class="alert alert-warning">Owner not found.</div>
        <?php else: ?>
            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <div class="p-4 bg-light rounded-4">
                        <h5 class="mb-3"><i class="bi bi-person-fill text-primary me-2"></i><?= htmlspecialchars($owner['name']) ?></h5>
                        <p class="mb-2"><strong>CC:</strong> <?= htmlspecialchars($owner['cc']) ?></p>
                        <p class="mb-2"><strong>Email:</strong> <?= htmlspecialchars($owner['email']) ?></p>
                        <p class="mb-2"><strong>Phone:</strong> <?= htmlspecialchars($owner['phone']) ?></p>
                        <a href="?view=owners&action=edit&cc=<?= urlencode($owner['cc']) ?>" class="btn btn-sm btn-outline-secondary mt-3"><i class="bi bi-pencil-square"></i> Edit Owner</a>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="p-4 bg-white rounded-4 border h-100">
                        <h5 class="mb-3"><i class="bi bi-car-front-fill text-success me-2"></i>Owned Cars</h5>
                        <?php if (empty($cars)): ?>
                            <div class="alert alert-info">No cars registered for this owner yet.</div>
                        <?php else: ?>
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
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
                                                    <a href="?view=cars&action=view&license_plate=<?= urlencode($car['license_plate']) ?>" class="btn btn-sm btn-outline-info"><i class="bi bi-tools"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
