<div class="main-content d-flex flex-column min-vh-100">
    <div class="container py-5">
        <h5 class="fw-bold mb-2 ps-2">Create Reservation</h5>

        <div class="card card-custom w-100">
            <div class="card-body">
                <form method="POST" action="<?= base_url('reservation/store') ?>">
                    <?= csrf_field() ?>

                    <!-- Hotel Code -->
                    <div class="mb-3">
                        <label for="hotel_code" class="form-label">Hotel Code</label>
                        <input type="text" class="form-control" id="hotel_code" name="hotel_code" required>
                    </div>


<!-- Auth Identity Dropdown -->
<div class="mb-3">
    <label for="user_info_id" class="form-label">User Email (User Info)</label>
    <select id="user_info_id" name="user_info_id" class="form-control" required>
        <option value="">Select User Email</option>
        <?php foreach ($emails as $email) : ?>
            <option value="<?= esc($email['id']) ?>">
                <?= esc($email['email']) ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>


                    <!-- Hotel -->
                    <div class="mb-3">
                        <label for="hotel_id" class="form-label">Hotel</label>
                        <select id="hotel_id" name="hotel_id" class="form-control" required>
                            <option value="">Select Hotel</option>
                            <?php foreach ($hotels as $hotel) : ?>
                                <option value="<?= $hotel['id'] ?>"><?= esc($hotel['hotel_name']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Room -->
                    <div class="mb-3">
                        <label for="room_id" class="form-label">Room</label>
                        <select id="room_id" name="room_id" class="form-control" required>
                            <option value="">Select Room</option>
                            <?php foreach ($rooms as $room) : ?>
                                <option value="<?= $room['id'] ?>">Room #<?= esc($room['id']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Staff -->


                    <!-- Discount -->
                    <div class="mb-3">
                        <label for="discount_id" class="form-label">Discount</label>
                        <select id="discount_id" name="discount_id" class="form-control">
                            <option value="">Select Discount</option>
                            <?php foreach ($discounts as $discount) : ?>
                                <option value="<?= $discount['id'] ?>">
                                    <?= esc($discount['discount_name']) ?> - <?= esc($discount['discount_type']) ?> (<?= esc($discount['value']) ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Check In -->
                    <div class="mb-3">
                        <label for="check_in" class="form-label">Check In</label>
                        <input type="date" id="check_in" name="check_in" class="form-control" required>
                    </div>

                    <!-- Check Out -->
                    <div class="mb-3">
                        <label for="check_out" class="form-label">Check Out</label>
                        <input type="date" id="check_out" name="check_out" class="form-control" required>
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select id="status" name="status" class="form-control" required>
                            <option value="active">Active</option>
                            <option value="cancelled">Cancelled</option>
                            <option value="completed">Completed</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Create Reservation</button>
                </form>
            </div>
        </div>
    </div>
</div>
