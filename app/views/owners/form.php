<?php
$editing = !empty($owner);
?>

<h3><?= $editing ? 'Edit Owner' : 'Register Owner' ?></h3>

<form method="post" action="?view=owners&action=<?= $editing ? 'update' : 'save' ?>" class="row g-3">
    <?php if ($editing): ?>
        <input type="hidden" name="original_cc" value="<?= htmlspecialchars($owner['cc']) ?>">
    <?php endif; ?>

    <div class="col-md-6">
        <label class="form-label">CC</label>
        <input type="text" name="cc" class="form-control" required value="<?= htmlspecialchars($owner['cc'] ?? '') ?>" <?= $editing ? 'readonly' : '' ?>>
    </div>
    <div class="col-md-6">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control" required value="<?= htmlspecialchars($owner['name'] ?? '') ?>">
    </div>
    <div class="col-md-6">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($owner['email'] ?? '') ?>">
    </div>
    <div class="col-md-6">
        <label class="form-label">Phone</label>
        <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($owner['phone'] ?? '') ?>">
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-success">Save</button>
        <a href="?view=owners" class="btn btn-secondary">Cancel</a>
    </div>
</form>