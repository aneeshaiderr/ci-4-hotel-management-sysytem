<div class="main-content d-flex flex-column min-vh-100">
  <div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h5 class="fw-bold mb-0">Create New Discount</h5>
    </div>

    <div class="card card-custom w-100">
      <div class="card-body">
        <form action="<?= base_url('discount/store') ?>" method="POST">
          <?= csrf_field() ?>

          <!-- Discount Type -->
          <div class="mb-3">
            <label class="form-label fw-bold">Discount Type</label>
            <input
              type="text"
              name="discount_type"
              class="form-control"
              placeholder="Enter discount type (e.g. Percentage or Flat)"
              value="<?= old('discount_type') ?>"
              required
            >
          </div>

          <!-- Discount Name -->
          <div class="mb-3">
            <label class="form-label fw-bold">Discount Name</label>
            <input
              type="text"
              name="discount_name"
              class="form-control"
              placeholder="Enter discount name (e.g. Summer Sale, New Year Offer)"
              value="<?= old('discount_name') ?>"
              required
            >
          </div>

          <!-- Discount Value -->
          <div class="mb-3">
            <label class="form-label fw-bold">Discount Value</label>
            <input
              type="number"
              name="value"
              step="0.01"
              class="form-control"
              placeholder="Enter discount value (e.g. 10 or 1500.00)"
              value="<?= old('value') ?>"
              required
            >
          </div>

          <!-- Start Date -->
          <div class="mb-3">
            <label class="form-label fw-bold">Start Date</label>
            <input
              type="date"
              name="start_date"
              class="form-control"
              value="<?= old('start_date') ?>"
              required
            >
          </div>

          <!-- End Date -->
          <div class="mb-3">
            <label class="form-label fw-bold">End Date</label>
            <input
              type="date"
              name="end_date"
              class="form-control"
              value="<?= old('end_date') ?>"
              required
            >
          </div>

          <!-- Status -->
          <div class="mb-3">
            <label class="form-label fw-bold">Status</label>
            <select name="status" class="form-select" required>
              <option value="">Select Status</option>
              <option value="Active" <?= old('status') === 'Active' ? 'selected' : '' ?>>Active</option>
              <option value="Inactive" <?= old('status') === 'Inactive' ? 'selected' : '' ?>>Inactive</option>
            </select>
          </div>

          <!-- Buttons -->
          <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success">Save Discount</button>
            <a href="<?= base_url('discount') ?>" class="btn btn-secondary btn-sm">← Back to List</a>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
