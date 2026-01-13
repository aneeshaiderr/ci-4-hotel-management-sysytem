

<div class="main-content d-flex flex-column min-vh-100">

    <!-- User Heading -->
    <div class="container py-5">
        <h5 class="fw-bold mb-2 ps-2">Hotels</h5>

        <!-- Create Button -->
        <div class="mb-2">
            <a href="<?= base_url('hotel/create') ?>" class="btn btn-sm btn-success">
                + Create Hotel
            </a>
        </div>

        <div class="card card-custom w-100">
            <div class="card-body">
                <h6 class="mb-3 fw-bold">Hotel List</h6>

                <table id="example" class="table table-striped table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Hotel Name</th>
                            <th>Address</th>
                            <th>Contact</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if (!empty($hotels)) : ?>
                            <?php foreach ($hotels as $hotel) : ?>
                                <tr>
                                    <td><?= esc($hotel['id']) ?></td>
                                    <td><?= esc($hotel['hotel_name']) ?></td>
                                    <td><?= esc($hotel['address']) ?></td>
                                    <td><?= esc($hotel['contact_no']) ?></td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                             <a href="<?=base_url('hotel/edit/' . $hotel['id']) ?>"
                                  class="btn btn-sm btn-primary py-1 px-3">view</a>

                                            <form class="delete-form"  data-confirm="Are you sure you want to delete this hotel?" action="<?= base_url('hotel/delete') ?>"
                                                  class="m-0">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="id" value="<?= esc($hotel['id']) ?>">
                                                <button type="submit"
                                                        class="btn btn-sm btn-danger py-1 px-3">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted">No hotels found.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
