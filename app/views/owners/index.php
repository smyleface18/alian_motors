<div class="card section-card shadow-sm mb-4">
    <div class="card-body d-flex flex-column flex-md-row justify-content-between align-items-start gap-3">
        <div>
            <h3 class="mb-1"><i class="bi bi-people-fill text-primary me-2"></i>Owners</h3>
            <p class="text-muted mb-0">Filtra propietarios por CC o nombre y revisa sus autos rápidamente.</p>
        </div>
        <a href="?view=owners&action=create" class="btn btn-primary btn-lg">
            <i class="bi bi-person-plus"></i> Register Owner
        </a>
    </div>
</div>

<form class="card section-card shadow-sm mb-4 p-4" method="get" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
    <input type="hidden" name="view" value="owners">
    <div class="row gy-3 align-items-end">
        <div class="col-md-3">
            <label class="form-label">Filter by</label>
            <select name="filter_by" class="form-select">
                <option value="cc" <?= ($filterBy === 'cc') ? 'selected' : '' ?>>CC</option>
                <option value="name" <?= ($filterBy === 'name') ? 'selected' : '' ?>>Name</option>
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">Search</label>
            <input type="search" name="filter_value" class="form-control" value="<?= htmlspecialchars($filterValue ?? '') ?>" placeholder="Search owner by CC or name">
        </div>
        <div class="col-md-3 d-grid">
            <button type="submit" class="btn btn-outline-primary btn-lg"><i class="bi bi-funnel-fill me-1"></i> Filter</button>
        </div>
    </div>
</form>

<?php if (empty($owners)): ?>
    <div class="alert alert-info rounded-4 shadow-sm">No owners registered.</div>
<?php else: ?>
    <div class="d-flex justify-content-between align-items-center mb-3">
        <span class="text-muted">Showing <?= count($owners) ?> owner<?= count($owners) === 1 ? '' : 's' ?>.</span>
        <span class="badge bg-primary">Simple owner management</span>
    </div>
    <div class="card section-card shadow-sm overflow-auto">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>CC</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($owners as $owner): ?>
                    <tr>
                        <td><?= htmlspecialchars($owner['cc']) ?></td>
                        <td><?= htmlspecialchars($owner['name']) ?></td>
                        <td><?= htmlspecialchars($owner['email']) ?></td>
                        <td><?= htmlspecialchars($owner['phone']) ?></td>
                        <td class="text-nowrap">
                            <a href="?view=owners&action=view&cc=<?= urlencode($owner['cc']) ?>" class="btn btn-sm btn-outline-info me-1"><i class="bi bi-card-list"></i></a>
                            <a href="?view=owners&action=edit&cc=<?= urlencode($owner['cc']) ?>" class="btn btn-sm btn-outline-secondary me-1"><i class="bi bi-pencil-square"></i></a>
                            <a href="?view=owners&action=delete&cc=<?= urlencode($owner['cc']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this owner?');"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>
