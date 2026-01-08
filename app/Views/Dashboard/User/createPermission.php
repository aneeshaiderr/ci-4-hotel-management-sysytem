<div class="main-content d-flex flex-column min-vh-100">
    <div class="container py-5">

        <h5 class="fw-bold mb-4">Assign Permission to User</h5>

        <form action="<?= site_url('permission/store') ?>" method="post">

            <!-- User ID Dropdown -->
            <div class="mb-3">
                <label class="form-label">Select User ID</label>
                <select name="user_id" class="form-control" required>
                    <option value="">-- Select User --</option>
                    <?php foreach ($users as $user): ?>
                        <option value="<?= esc($user['user_id']) ?>">
                            User ID: <?= esc($user['user_id']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Permission Text -->
            <div class="mb-3">
                <label class="form-label">Permission</label>
                <input
                    type="text"
                    name="permission"
                    class="form-control"
                    placeholder="e.g. discount.add, discount.delete"
                    required
                >
            </div>

            <button type="submit" class="btn btn-primary">Assign Permission</button>

        </form>

    </div>
</div>
