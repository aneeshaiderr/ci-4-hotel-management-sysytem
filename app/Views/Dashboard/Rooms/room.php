<div class="main-content d-flex flex-column min-vh-100">
  <div class="container py-5">
    <h5 class="fw-bold mb-2 mt-7 ps-2">Room</h5>

    <!-- Create Room Button -->
    <div class="mb-2">
      <a href="<?= base_url('room/create') ?>"
         class="btn btn-sm btn-success"
         style="background-color:#16a34a; color:white; padding:8px 16px; border-radius:6px; text-decoration:none;">
         + Create Room
      </a>
    </div>

    <div class="card card-custom w-100">
      <div class="card-body">
        <h6 class="mb-3 fw-bold">Room List</h6>
        <table id="example" class="table table-striped table-bordered align-middle">
          <thead class="table-light">
            <tr>
              <th>Room ID</th>
              <th>Room Number</th>
              <th>Floor</th>
              <th>Room Bed</th>
              <th>Max Guest</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if (! empty($rooms)) : ?>
              <?php foreach ($rooms as $room) : ?>
                <tr>
                  <td><?= esc($room['id']) ?></td>
                  <td><?= esc($room['room_number']) ?></td>
                  <td><?= esc($room['floor']) ?></td>
                  <td><?= esc($room['beds']) ?></td>
                  <td><?= esc($room['max_guests']) ?></td>
                  <td>
                    <?php if ($room['status'] === 'available') : ?>
                      <span class="badge bg-success">Available</span>
                    <?php elseif ($room['status'] === 'booked') : ?>
                      <span class="badge bg-danger">Booked</span>
                    <?php else : ?>
                      <span class="badge bg-warning text-dark">Maintenance</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <!-- Action Buttons -->
                    <a href="<?= base_url('room/edit/' . $room['id']) ?>"
                       class="btn btn-sm btn-success me-2">View</a>

                    <form action="<?= base_url('room/delete') ?>" method="POST" style="display:inline;">
                      <?= csrf_field() ?>
                      <input type="hidden" name="id" value="<?= esc($room['id']) ?>">
                      <button type="submit" class="btn btn-sm btn-danger"
                          onclick="return confirm('Are you sure you want to delete this room?');">
                          Delete
                      </button>
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else : ?>
              <tr>
                <td colspan="7" class="text-center">No rooms found.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
