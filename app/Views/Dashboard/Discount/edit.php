<div class="main-content d-flex flex-column min-vh-100">
  <div class="container py-5">
    <main>
      <div class="mx-auto max-w-4xl py-7 px-7">
        <h5 class="fw-bold mb-4">Edit Discount</h5>

        <form method="POST" action="<?= base_url('discount/update') ?>">
          <?= csrf_field() ?>

          <input type="hidden" name="id" value="<?= esc($discount['id']) ?>">

          <!-- Discount Type -->
          <div class="mb-4">
            <label for="discount_type" class="form-label fw-bold">Discount Type</label>
            <select id="discount_type" name="discount_type" class="form-control" required>
              <option value="">Select Type</option>
              <option value="percentage" <?= strtolower($discount['discount_type']) === 'percentage' ? 'selected' : '' ?>>Percentage</option>
              <option value="amount" <?= strtolower($discount['discount_type']) === 'amount' ? 'selected' : '' ?>>Amount</option>
            </select>
          </div>

          <!-- Discount Name -->
          <div class="mb-4">
            <label for="discount_name" class="form-label fw-bold">Discount Name</label>
            <input type="text" id="discount_name" name="discount_name"
              value="<?= esc($discount['discount_name']) ?>"
              class="form-control" placeholder="Enter discount name" required>
          </div>

          <!-- Discount Value -->
          <div class="mb-4">
            <label for="value" class="form-label fw-bold">Discount Value</label>
            <input type="number" step="0.01" id="value" name="value"
              value="<?= esc($discount['value']) ?>"
              class="form-control" placeholder="Enter discount value" required>
          </div>

          <!-- Start Date -->
          <div class="mb-4">
            <label for="start_date" class="form-label fw-bold">Start Date</label>
            <input type="date" id="start_date" name="start_date"
              value="<?= esc($discount['start_date']) ?>"
              class="form-control" required>
          </div>

          <!-- End Date -->
          <div class="mb-4">
            <label for="end_date" class="form-label fw-bold">End Date</label>
            <input type="date" id="end_date" name="end_date"
              value="<?= esc($discount['end_date']) ?>"
              class="form-control" required>
          </div>

          <!-- Status -->
          <div class="mb-4">
            <label for="status" class="form-label fw-bold">Status</label>
            <select id="status" name="status" class="form-control" required>
              <option value="active" <?= strtolower($discount['status']) === 'active' ? 'selected' : '' ?>>Active</option>
              <option value="inactive" <?= strtolower($discount['status']) === 'inactive' ? 'selected' : '' ?>>Inactive</option>
            </select>
          </div>

          <!-- Buttons -->
          <div class="mt-6 d-flex justify-end gap-2">
            <a href="<?= base_url('discount') ?>" class="btn btn-secondary">Back</a>
            <button type="submit"
              class="btn btn-success"
              onmouseover="this.style.backgroundColor='#15803d'"
              onmouseout="this.style.backgroundColor='#16a34a'">
              Update Discount
            </button>
          </div>
        </form>
      </div>
    </main>
  </div>
</div>
