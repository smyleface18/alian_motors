<?php
$editing = !empty($owner);
$formData = $old ?? ($owner ?? []);
?>

<h3><?= $editing ? 'Edit Owner' : 'Register Owner' ?></h3>

<?php if (!empty($errors)): ?>
    <div class="alert alert-danger">
        <strong>Please fix the following:</strong>
        <ul class="mb-0">
            <?php foreach ($errors as $error): ?>
                <li><?= htmlspecialchars($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

<form method="post" action="?view=owners&action=<?= $editing ? 'update' : 'save' ?>" class="row g-3">
    <?php if ($editing): ?>
        <input type="hidden" name="original_cc" value="<?= htmlspecialchars($formData['cc'] ?? '') ?>">
    <?php endif; ?>

    <div class="col-md-6">
        <label class="form-label">CC</label>
        <input type="text" name="cc" class="form-control" required value="<?= htmlspecialchars($formData['cc'] ?? '') ?>" <?= $editing ? 'readonly' : '' ?>>
    </div>
    <div class="col-md-6">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control" required value="<?= htmlspecialchars($formData['name'] ?? '') ?>">
    </div>
    <div class="col-md-6">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($formData['email'] ?? '') ?>">
    </div>
    <div class="col-md-6">
        <label class="form-label">Phone</label>
        <input type="text" name="phone" class="form-control" value="<?= htmlspecialchars($formData['phone'] ?? '') ?>">
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-success">Save</button>
        <a href="?view=owners" class="btn btn-secondary">Cancel</a>
    </div>
</form>