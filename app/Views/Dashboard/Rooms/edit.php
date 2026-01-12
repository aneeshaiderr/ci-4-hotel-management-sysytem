<div class="main-content d-flex flex-column min-vh-100">
    <div class="container py-5">
        <main>
            <div class="mx-auto max-w-4xl py-7 px-7">

                <h5 class="fw-bold mb-4">Edit Room</h5>

                <form method="POST" id="editRoomForm" >
                    <?= csrf_field() ?>

                    <input type="hidden" name="id" value="<?= (int) $room['id'] ?>">

                    <!-- Room Number -->
                    <div class="mb-4">
                        <label for="room_number">Room Number</label>
                        <input type="number" id="room_number" name="room_number"
                               value="<?= (int) $room['room_number'] ?>" required
                               class="form-control">
                    </div>

                    <!-- Floor -->
                    <div class="mb-4">
                        <label for="floor">Floor</label>
                        <input type="number" id="floor" name="floor"
                               value="<?= (int) $room['floor'] ?>" required
                               class="form-control">
                    </div>

                    <!-- Room Bed -->
                    <div class="mb-4">
                        <label for="beds">Beds</label>
                        <input type="number" id="beds" name="beds"
                               value="<?= (int) $room['beds'] ?>" required
                               class="form-control">
                    </div>

                    <!-- Max Guests -->
                    <div class="mb-4">
                        <label for="max_guests">Max Guests</label>
                        <input type="number" id="max_guests" name="max_guests"
                               value="<?= (int) $room['max_guests'] ?>" required
                               class="form-control">
                    </div>

                    <!-- Status -->
                    <div class="mb-4">
                        <label for="status">Status</label>
                        <select id="status" name="status" class="form-control" required>
                            <option value="available" <?= $room['status'] === 'available' ? 'selected' : '' ?>>Available</option>
                            <option value="booked" <?= $room['status'] === 'booked' ? 'selected' : '' ?>>Booked</option>
                            <option value="maintenance" <?= $room['status'] === 'maintenance' ? 'selected' : '' ?>>Maintenance</option>
                        </select>
                    </div>

                    <!-- Buttons -->
                    <div class="mt-6 d-flex justify-content-end gap-2">
                        <a href="<?= base_url('rooms') ?>" class="btn btn-secondary">Cancel</a>
                        <button type="submit"
                          id="updateBtn"
                                class="btn btn-success"
                                style="background-color:#16a34a;"
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(function () {

    $('#editRoomForm').on('submit', function (e) {
        e.preventDefault();

        console.log($(this).serialize());

        $.ajax({
            url: "<?= base_url('room/update') ?>",
            type: "POST",
            data: $(this).serialize(),
            dataType: "json",

            beforeSend: function () {
                $('#updateBtn')
                    .prop('disabled', true)
                    .text('Updating...');
            },

            success: function (response) {

                if (response.status === 'success') {
                    alert(response.message);

                    // redirect after success
                    window.location.href = "<?= base_url('rooms') ?>";

                } else {
                    alert(response.message || 'Update failed');
                }
            },

            error: function (xhr) {
                alert('Server error!');
                console.log(xhr.responseText);
            },

            complete: function () {
                $('#updateBtn')
                    .prop('disabled', false)
                    .text('Update');
            }
        });
    });

});
</script>
