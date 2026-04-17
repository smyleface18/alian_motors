<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Owners</h3>
    <a href="?view=owners&action=create" class="btn btn-primary">Register Owner</a>
</div>

<form class="row g-3 mb-4" method="get" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
    <input type="hidden" name="view" value="owners">
    <div class="col-md-3">
        <label class="form-label">Filter by</label>
        <select name="filter_by" class="form-select">
            <option value="cc" <?= ($filterBy === 'cc') ? 'selected' : '' ?>>CC</option>
            <option value="name" <?= ($filterBy === 'name') ? 'selected' : '' ?>>Name</option>
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">Search</label>
        <input type="search" name="filter_value" class="form-control" value="<?= htmlspecialchars($filterValue ?? '') ?>" placeholder="Search by CC or name">
    </div>
    <div class="col-md-3 d-flex align-items-end">
        <button type="submit" class="btn btn-outline-primary w-100">Filter</button>
    </div>
</form>

<?php if (empty($owners)): ?>
    <div class="alert alert-info">No owners registered.</div>
<?php else: ?>
    <table class="table table-striped">
        <thead>
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
                    <td>
                        <a href="?view=owners&action=view&cc=<?= urlencode($owner['cc']) ?>" class="btn btn-sm btn-outline-info">Cars</a>
                        <a href="?view=owners&action=edit&cc=<?= urlencode($owner['cc']) ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
                        <a href="?view=owners&action=delete&cc=<?= urlencode($owner['cc']) ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this owner?');">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
