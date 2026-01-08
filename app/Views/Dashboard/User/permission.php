<div class="main-content d-flex flex-column min-vh-100">
    <div class="container py-5">

        <h5 class="fw-bold mb-3">User Permissions</h5>

        <!-- Add Permission Button -->
        <div class="mb-4">
            <a href="<?= base_url('permission/createPermission') ?>" class="btn btn-sm btn-success">
                + Assign Permission
            </a>
        </div>

        <div class="card w-100">
            <div class="card-body">

                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th width="60">ID</th>
                            <th width="100">User ID</th>
                            <th>Permission</th>
                            <th width="180">Created At</th>
                            <th width="150">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (!empty($permissions)): ?>
                            <?php foreach ($permissions as $row): ?>
                                <tr>
                                    <td><?= esc($row['id']) ?></td>
                                    <td><?= esc($row['user_id']) ?></td>
                                    <td>
                                        <span class="badge bg-info text-dark">
                                            <?= esc($row['permission']) ?>
                                        </span>
                                    </td>
                                    <td><?= esc($row['created_at']) ?></td>
                                    <td class="d-flex gap-2">

                                        <!-- View Button -->
                                        <a href="<?= base_url('permission/view/' . $row['id']) ?>"
                                           class="btn btn-sm btn-primary">
                                            View
                                        </a>

                                     <form action="<?= base_url('permission/delete') ?>"
      method="post"
      style="display:inline-block;"
      onsubmit="return confirm('Are you sure you want to delete this permission?');">



    <input type="hidden" name="id" value="<?= esc($row['id']) ?>">

    <button type="submit" class="btn btn-sm btn-danger py-1 px-3">
        Delete
    </button>
</form>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    No permissions found
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>

                </table>

            </div>
        </div>

    </div>
</div>
