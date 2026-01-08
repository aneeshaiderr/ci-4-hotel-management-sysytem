<div class="main-content d-flex flex-column min-vh-100">
    <div class="container py-5">
        <h5 class="fw-bold mb-3 ps-2">Add New Service</h5>

        <div class="card card-custom w-100">
            <div class="card-body">

                <!-- Create Service Form -->
                <form action="<?= base_url('services/store') ?>" method="post">


                    <?= csrf_field() ?>

                    <!-- Service Name -->
                    <div class="mb-3">
                        <label for="service_name" class="form-label fw-bold">
                            Service Name
                        </label>
                        <input
                            type="text"
                            name="service_name"
                            id="service_name"
                            class="form-control"
                            placeholder="Enter service name"
                            value="<?= old('service_name') ?>"
                            required
                        >
                    </div>

                    <!-- Price -->
                    <div class="mb-3">
                        <label for="price" class="form-label fw-bold">
                            Price
                        </label>
                        <input
                            type="number"
                            name="price"
                            id="price"
                            class="form-control"
                            placeholder="Enter price"
                            step="0.01"
                            value="<?= old('price') ?>"
                            required
                        >
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label for="status" class="form-label fw-bold">
                            Status
                        </label>
                        <select
                            name="status"
                            id="status"
                            class="form-select"
                            required
                        >
                            <option value="">-- Select Status --</option>
                            <option value="active" <?= old('status') === 'active' ? 'selected' : '' ?>>
                                Active
                            </option>
                            <option value="inactive" <?= old('status') === 'inactive' ? 'selected' : '' ?>>
                                Inactive
                            </option>
                        </select>
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex justify-content-between">
                        <a href="<?= base_url('services') ?>" class="btn btn-secondary">
                            Back
                        </a>

                        <button type="submit" class="btn btn-success">
                            Create Service
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
