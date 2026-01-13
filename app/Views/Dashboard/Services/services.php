<div class="main-content d-flex flex-column min-vh-100">
    <div class="container py-5">

        <!-- Page Heading -->
        <h5 class="fw-bold mb-2 ps-2">Service</h5>

        <!-- Create Service Button -->
        <div class="mb-4">
            <a href="<?= base_url('services/create') ?>" class="btn btn-sm btn-success">
                + Create Services
            </a>
        </div>

        <!-- Card -->
        <div class="card card-custom w-100">
            <div class="card-body">

                <h6 class="mb-3 fw-bold">Service List</h6>

                <table id="example" class="table table-striped table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Service ID</th>
                            <th>Service Name</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (!empty($services)) : ?>
                            <?php foreach ($services as $service) : ?>
                                <tr>
                                    <td><?= esc($service['id']) ?></td>
                                    <td><?= esc($service['service_name']) ?></td>
                                    <td>$<?= esc($service['price']) ?></td>

                                    <!-- Status -->
                                    <td>
                                        <?php
                                            $status = strtolower($service['status']);
                                        ?>
                                        <?php if ($status === 'active') : ?>
                                            <span class="badge bg-success">Active</span>
                                        <?php elseif ($status === 'inactive') : ?>
                                            <span class="badge bg-danger">Inactive</span>
                                        <?php else : ?>
                                            <span class="badge bg-warning text-dark">
                                                <?= esc($service['status']) ?>
                                            </span>
                                        <?php endif; ?>
                                    </td>

                                    <!-- Actions -->
                                    <td>
                                        <div class="d-flex align-items-center gap-2">

                                            <!-- View / Edit -->
                                            <a href="<?= base_url('services/edit/' . $service['id']) ?>"
                                               class="btn btn-sm btn-primary py-1 px-3">
                                                View
                                            </a>



                                            <!-- Delete -->
                                            <form class="delete-form" action="<?= base_url('services/delete') ?>" data-confirm="Are you sure you want to delete this service?">
                                            <?= csrf_field() ?>
                                        <input type="hidden" name="id" value="<?= esc($service['id']) ?>">

                                        <button type="submit"
                                       class="btn btn-sm btn-danger py-1 px-3 btn-delete">Delete</button>
                                          </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    No services found
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
