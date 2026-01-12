<div class="main-content d-flex flex-column min-vh-100">
  <div class="container py-5">
    <main>
      <div class="mx-auto max-w-4xl py-7 px-7">
        <h5 class="fw-bold mb-4">Edit Reservation</h5>

        <form method="POST" action="<?= base_url('/reservation/update') ?>">
          <?= csrf_field() ?>
          <input type="hidden" name="id" value="<?= esc($reservation['id']) ?>">

          <!-- Hotel Code -->
          <div class="mb-4">
            <label>Hotel Code</label>
            <input type="text" name="hotel_code"
              value="<?= esc($reservation['hotel_code']) ?>"
              class="form-control" required>
          </div>

          <!-- Hotel -->
          <div class="mb-4">
            <label>Hotel</label>
            <select name="hotel_id" class="form-control" required>
              <option value="">Select Hotel</option>
              <?php foreach ($hotels as $hotel): ?>
                <option value="<?= $hotel['id'] ?>"
                  <?= $hotel['id'] == $reservation['hotel_id'] ? 'selected' : '' ?>>
                  <?= esc($hotel['hotel_name']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Room -->
          <div class="mb-4">
            <label>Room</label>
            <select name="room_id" class="form-control" required>
              <option value="">Select Room</option>
              <?php foreach ($rooms as $room): ?>
                <option value="<?= $room['id'] ?>"
                  <?= $room['id'] == $reservation['room_id'] ? 'selected' : '' ?>>
                  Room #<?= esc($room['id']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Discount -->
          <div class="mb-4">
            <label>Discount</label>
            <select name="discount_id" class="form-control">
              <option value="">No Discount</option>
              <?php foreach ($discounts as $discount): ?>
                <option value="<?= $discount['id'] ?>"
                  <?= $discount['id'] == $reservation['discount_id'] ? 'selected' : '' ?>>
                  <?= esc($discount['discount_name']) ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- Check In -->
          <div class="mb-4">
            <label>Check In</label>
            <input type="date" name="check_in"
              value="<?= esc($reservation['check_in']) ?>"
              class="form-control" required>
          </div>

          <!-- Check Out -->
          <div class="mb-4">
            <label>Check Out</label>
            <input type="date" name="check_out"
              value="<?= esc($reservation['check_out']) ?>"
              class="form-control" required>
          </div>

          <!-- Status -->
          <div class="mb-4">
            <label>Status</label>
            <select name="status" class="form-control" required>
              <option value="active" <?= $reservation['status']=='active'?'selected':'' ?>>Active</option>
              <option value="completed" <?= $reservation['status']=='completed'?'selected':'' ?>>Completed</option>
              <option value="cancelled" <?= $reservation['status']=='cancelled'?'selected':'' ?>>Cancelled</option>
            </select>
          </div>

          <!-- Buttons -->
          <div class="d-flex justify-content-end gap-3">
            <a href="<?= base_url('/reservation') ?>" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-success">
              Update Reservation
            </button>
          </div>

        </form>
      </div>
    </main>
  </div>
</div>
