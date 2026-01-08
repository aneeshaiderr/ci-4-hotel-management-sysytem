<div class="main-content d-flex flex-column min-vh-100">
    <div class="container py-5">
        <h5 class="fw-bold mb-2 ps-2">Discount</h5>

        <!-- Create Button -->
        <div class="mb-4">
            <a href="<?= base_url('discount/create') ?>" class="btn btn-sm btn-success">
                + Create Discount
            </a>
        </div>

        <div class="card card-custom w-100">
            <div class="card-body">
                <h6 class="mb-3 fw-bold">Discount List</h6>

                <table id="example" class="table table-striped table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Discount Type</th>
                            <th>Discount Name</th>
                            <th>Value</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (!empty($discounts)) : ?>
                            <?php foreach ($discounts as $discount) : ?>
                                <tr>
                                    <td><?= esc($discount['id']) ?></td>
                                    <td><?= esc($discount['discount_type'] ?? '') ?></td>
                                    <td><?= esc($discount['discount_name'] ?? '') ?></td>
                                    <td><?= esc($discount['value'] ?? '') ?></td>
                                    <td><?= esc($discount['start_date'] ?? '') ?></td>
                                    <td><?= esc($discount['end_date'] ?? '') ?></td>

                                    <td>
                                        <?php
                                            $status = strtolower($discount['status'] ?? '');
                                        ?>
                                        <?php if ($status === 'active') : ?>
                                            <span class="badge bg-success">Active</span>
                                        <?php elseif ($status === 'inactive') : ?>
                                            <span class="badge bg-danger">Inactive</span>
                                        <?php else : ?>
                                            <span class="badge bg-warning text-dark">
                                                <?= esc($discount['status'] ?? 'Unknown') ?>
                                            </span>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <a href="<?= base_url('discount/edit/' . $discount['id']) ?>"
                                               class="btn btn-sm btn-primary py-1 px-3">
                                                View
                                            </a>




                                            <?php

                                            $auth = auth();


                                            // Check if a user is logged in
                                            if ($user = $auth->user()) {
                                                $currentUser = $user;

                                            }

                                            ?>
                                            <?php if($user->can('discount.delete')): ?>
                                                <form action="<?= base_url('discount/delete') ?>"
                                                      method="post"
                                                      class="m-0"
                                                      onsubmit="return confirm('Are you sure you want to delete this discount?');">
                                                    <?= csrf_field() ?>
                                                    <input type="hidden" name="id" value="<?= esc($discount['id']) ?>">
                                                    <button type="submit"
                                                            class="btn btn-sm btn-danger py-1 px-3">
                                                        Delete
                                                    </button>
                                                </form>
                                            <?php
                                             endif;
                                            ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="8" class="text-center text-muted">
                                    No discounts found
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
