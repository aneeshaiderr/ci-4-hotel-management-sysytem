<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<div class="main-content d-flex flex-column min-vh-100">
    <div class="container py-5">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold mb-2 ps-2">Reservations</h5>
        </div>

        <!-- Create Button -->
        <div class="mb-4">
            <a href="<?= base_url('reservation/create') ?>"
               class="btn btn-sm btn-success"
               style="background-color:#16a34a; color:white; padding:8px 16px; border-radius:6px; text-decoration:none;">
                + Create Reservation
            </a>
        </div>

        <div class="card card-custom w-100">
            <div class="card-body">
                <h6 class="mb-3 fw-bold">Reservation List</h6>

                <table id="example" class="table table-striped table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Hotel Code</th>
                            <th>Email</th>
                            <th>Hotel Name</th>
                            <th>Room ID</th>
                            <th>Discount Name</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($reservations)) : ?>
                            <?php foreach ($reservations as $res) : ?>
                                <tr>
                                    <td><?= esc($res['hotel_code'] ?? '') ?></td>

                                    <td><?= esc($res['email'] ?? '') ?></td>
                                    <td><?= esc($res['hotel_name'] ?? '') ?></td>
                                    <td><?= esc($res['room_id'] ?? '') ?></td>
                                    <td><?= esc($res['discount_name'] ?? '') ?></td>
                                    <td><?= esc($res['check_in'] ?? '') ?></td>
                                    <td><?= esc($res['check_out'] ?? '') ?></td>
                                    <td>
                                        <?php $status = strtolower($res['status'] ?? ''); ?>
                                        <?php if ($status === 'active') : ?>
                                            <span class="badge bg-success">Active</span>
                                        <?php elseif ($status === 'inactive') : ?>
                                            <span class="badge bg-danger">Inactive</span>
                                        <?php else : ?>
                                            <span class="badge bg-warning text-dark"><?= esc($res['status'] ?? '') ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-1">
                                            <a href="<?= base_url('reservation/edit/' . ($res['id'] )) ?>"
                                               class="btn btn-sm btn-primary py-1 px-3">
                                                View
                                            </a>

                                            <form action="<?= base_url('reservation/delete') ?>"
                                                  method="POST"
                                                  onsubmit="return confirm('Are you sure you want to delete this reservation?');"
                                                  class="m-0">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="id" value="<?= esc($res['id'] ?? '') ?>">
                                                <button type="submit" class="btn btn-sm btn-danger py-1 px-3">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="10" class="text-center text-muted">No reservations found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

            </div>
        </div>

    </div>
</div>
