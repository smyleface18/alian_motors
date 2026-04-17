<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Owners</h3>
    <a href="?view=owners&action=create" class="btn btn-primary">Register Owner</a>
</div>

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
            </tr>
        </thead>
        <tbody>
            <?php foreach ($owners as $owner): ?>
                <tr>
                    <td><?= htmlspecialchars($owner['cc']) ?></td>
                    <td><?= htmlspecialchars($owner['name']) ?></td>
                    <td><?= htmlspecialchars($owner['email']) ?></td>
                    <td><?= htmlspecialchars($owner['phone']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
