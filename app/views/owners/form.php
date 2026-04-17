<h3>Register Owner</h3>
<form method="post" action="?view=owners&action=save" class="row g-3">
    <div class="col-md-6">
        <label class="form-label">CC</label>
        <input type="text" name="cc" class="form-control" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control">
    </div>
    <div class="col-md-6">
        <label class="form-label">Phone</label>
        <input type="text" name="phone" class="form-control">
    </div>
    <div class="col-12">
        <button type="submit" class="btn btn-success">Save</button>
        <a href="?view=owners" class="btn btn-secondary">Cancel</a>
    </div>
</form>