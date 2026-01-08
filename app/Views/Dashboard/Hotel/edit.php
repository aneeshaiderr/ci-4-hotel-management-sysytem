<div class="main-content d-flex flex-column min-vh-100">
  <div class="container py-5">
    <main>
      <div class="mx-auto max-w-4xl py-7 px-7">
        <h5 class="fw-bold mb-4">Edit Hotel</h5>

        <!-- Form: Use POST + hidden _method PATCH for CI4 -->
        <form method="POST" action="<?= site_url('hotel/update') ?>">
          <?= csrf_field() ?> <!-- CI4 CSRF token -->

          <!-- Hidden fields -->
          <input type="hidden" name="id" value="<?= esc($hotel['id']) ?>">

          <!-- Hotel Name -->
          <div class="mb-4">
            <label for="hotel_name" class="form-label fw-bold">Hotel Name</label>
            <input type="text" id="hotel_name" name="hotel_name"
              value="<?= esc($hotel['hotel_name']) ?>" required
              class="form-control">
          </div>

          <!-- Address -->
          <div class="mb-4">
            <label for="address" class="form-label fw-bold">Address</label>
            <textarea id="address" name="address" class="form-control" required><?= esc($hotel['address']) ?></textarea>
          </div>

          <!-- Contact Number -->
          <div class="mb-4">
            <label for="contact_no" class="form-label fw-bold">Contact No</label>
            <input type="text" id="contact_no" name="contact_no"
              value="<?= esc($hotel['contact_no']) ?>" required
              class="form-control">
          </div>

          <!-- Buttons -->
          <div class="mt-6 d-flex justify-content-end gap-2">
            <a href="<?= site_url('hotel') ?>" class="btn btn-secondary">Cancel</a>
            <button type="submit"
              class="btn btn-success"
              style="background-color:#16a34a; color:white;"
              onmouseover="this.style.backgroundColor='#15803d'"
              onmouseout="this.style.backgroundColor='#16a34a'">
              Update
            </button>
          </div>
        </form>
      </div>
    </main>
  </div>
</div>
