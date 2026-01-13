<div class="main-content d-flex flex-column min-vh-100">
    <div class="container py-5">
        <main>
            <div class="mx-auto max-w-4xl py-7 px-7">

                <h5 class="fw-bold mb-4">Edit Room</h5>

                <?= form_open('', ['id' => 'editRoomForm']) ?>
                    <?= csrf_field() ?>

                    <?= form_hidden('id', (string)$room['id']) ?>

                    <!-- Room Number -->
                    <div class="mb-4">
                        <?= form_label('Room Number', 'room_number') ?>
                        <?= form_input([
                            'type' => 'number',
                            'id' => 'room_number',
                            'name' => 'room_number',
                            'value' => (string)$room['room_number'],
                            'class' => 'form-control',
                            'required' => true
                        ]) ?>
                    </div>

                    <!-- Floor -->
                    <div class="mb-4">
                        <?= form_label('Floor', 'floor') ?>
                        <?= form_input([
                            'type' => 'number',
                            'id' => 'floor',
                            'name' => 'floor',
                            'value' => (string)$room['floor'],
                            'class' => 'form-control',
                            'required' => true
                        ]) ?>
                    </div>

                    <!-- Beds -->
                    <div class="mb-4">
                        <?= form_label('Beds', 'beds') ?>
                        <?= form_input([
                            'type' => 'number',
                            'id' => 'beds',
                            'name' => 'beds',
                            'value' => (string)$room['beds'],
                            'class' => 'form-control',
                            'required' => true
                        ]) ?>
                    </div>

                    <!-- Max Guests -->
                    <div class="mb-4">
                        <?= form_label('Max Guests', 'max_guests') ?>
                        <?= form_input([
                            'type' => 'number',
                            'id' => 'max_guests',
                            'name' => 'max_guests',
                            'value' => (string)$room['max_guests'],
                            'class' => 'form-control',
                            'required' => true
                        ]) ?>
                    </div>

                    <!-- Status -->
                    <div class="mb-4">
                        <?= form_label('Status', 'status') ?>
                        <?= form_dropdown('status', [
                            'available' => 'Available',
                            'booked' => 'Booked',
                            'maintenance' => 'Maintenance'
                        ], (string)$room['status'], [
                            'id' => 'status',
                            'class' => 'form-control',
                            'required' => true
                        ]) ?>
                    </div>

                    <!-- Buttons -->
                    <div class="mt-6 d-flex justify-content-end gap-2">
                        <a href="<?= base_url('rooms') ?>" class="btn btn-secondary">Cancel</a>
                        <?= form_submit('submit', 'Update', [
                            'id' => 'updateBtn',
                            'class' => 'btn btn-success',
                            'style' => 'background-color:#16a34a;',
                            'onmouseover' => "this.style.backgroundColor='#15803d'",
                            'onmouseout'  => "this.style.backgroundColor='#16a34a'"
                        ]) ?>
                    </div>

                <?= form_close() ?>

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
                    .val('Updating...')
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
                    .val('Update')
                    .text('Update');
            }
        });
    });

});
</script>
