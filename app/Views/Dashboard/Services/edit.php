<div class="main-content d-flex flex-column min-vh-100">
    <div class="container py-5">
        <main>
            <div class="mx-auto max-w-4xl py-7 px-7">
                <h5 class="fw-bold mb-4">Edit Service</h5>

                <form method="POST" action="<?= site_url('services/update') ?>">
                    <?= csrf_field() ?>

                    <input type="hidden" name="id" value="<?= esc($service['id']) ?>">

                    <!-- Service Name -->
                    <div class="mb-4">
                        <label for="service_name" class="form-label fw-bold">
                            Service Name
                        </label>
                        <input
                            type="text"
                            id="service_name"
                            name="service_name"
                            value="<?= esc($service['service_name']) ?>"
                            class="form-control"
                            placeholder="Enter service name"
                            required
                        >
                    </div>

                    <!-- Price -->
                    <div class="mb-4">
                        <label for="price" class="form-label fw-bold">
                            Price
                        </label>
                        <input
                            type="number"
                            step="0.01"
                            id="price"
                            name="price"
                            value="<?= esc($service['price']) ?>"
                            class="form-control"
                            placeholder="Enter price"
                            required
                        >
                    </div>

                    <!-- Status -->
                    <div class="mb-4">
                        <label for="status" class="form-label fw-bold">
                            Status
                        </label>
                        <select id="status" name="status" class="form-select" required>
                            <option value="">Select Status</option>
                            <option value="active"
                                <?= strtolower($service['status']) === 'active' ? 'selected' : '' ?>>
                                Active
                            </option>
                            <option value="inactive"
                                <?= strtolower($service['status']) === 'inactive' ? 'selected' : '' ?>>
                                Inactive
                            </option>
                        </select>
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex justify-content-end gap-3">
                        <a href="<?= base_url('services') ?>" class="btn btn-secondary">
                            Back
                        </a>
                        <button
                            type="submit"
                            class="btn btn-success"
                            style="background-color:#16a34a;"
                            onmouseover="this.style.backgroundColor='#15803d'"
                            onmouseout="this.style.backgroundColor='#16a34a'">
                            Update Service
                        </button>
                    </div>

                </form>
            </div>
        </main>
    </div>
</div>
