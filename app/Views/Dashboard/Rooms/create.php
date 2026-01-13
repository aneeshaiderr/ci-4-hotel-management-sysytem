<div class="main-content d-flex flex-column min-vh-100">
    <div class="container py-5">
        <main>
            <div class="mx-auto max-w-4xl py-7 px-7">
                <h2 class="mb-4">Create Room</h2>

                <?= form_open('', ['id' => 'createRoomForm']) ?>
                    <?= csrf_field() ?>

                    <!-- Room Number -->
                    <div class="mb-4">
                        <?= form_label('Room Number', 'room_number') ?>
                        <?= form_input([
                            'type' => 'number',
                            'id' => 'room_number',
                            'name' => 'room_number',
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
                            'class' => 'form-control',
                            'required' => true
                        ]) ?>
                    </div>

                    <!-- Hotel Select -->
                    <div class="mb-4 position-relative">
                        <?= form_label('Select Hotel', 'hotelSearch', ['class' => 'form-label fw-semibold']) ?>
                        <?= form_input([
                            'type' => 'text',
                            'class' => 'form-control',
                            'id' => 'hotelSearch',
                            'placeholder' => 'Search or Select Hotel...',
                            'autocomplete' => 'off'
                        ]) ?>
                        <?= form_hidden('hotel_id',  ['id' => 'hotel_id']) ?>

                        <ul class="list-group position-absolute w-100 shadow-sm mt-1" id="hotelList" style="display:none; max-height:200px; overflow-y:auto; z-index:1050;"></ul>
                    </div>

                    <!-- Status -->
                    <div class="mb-4">
                        <?= form_label('Status', 'status') ?>
                        <?= form_dropdown('status', [
                            'available' => 'Available',
                            'booked' => 'Booked',
                            'maintenance' => 'Maintenance'
                        ], 'available', ['id' => 'status', 'class' => 'form-control', 'required' => true]) ?>
                    </div>

                    <!-- Buttons -->
                    <div class="mt-6 flex items-center justify-end gap-x-4">
                        <a href="<?= base_url('rooms') ?>" class="btn btn-secondary">Cancel</a>
                        <?= form_submit('submit', 'Create', [
                            'class' => 'btn',
                            'style' => 'background-color:#16a34a; color:white; padding:8px 16px; border-radius:6px; border:none;'
                        ]) ?>
                    </div>

                <?= form_close() ?>
            </div>
        </main>
    </div>
</div>

<!-- jQuery for hotel autocomplete -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(function(){
  const hotels = [
    <?php foreach ($hotels as $hotel): ?>
      { id: <?= $hotel['id'] ?>, hotel_name: "<?= addslashes($hotel['hotel_name']) ?>" },
    <?php endforeach; ?>
  ];

  const $input = $('#hotelSearch');
  const $list = $('#hotelList');

  $input.on('focus click', () => {
    $list.empty().show();
    hotels.forEach(h => $list.append(`<li class="list-group-item list-group-item-action" data-id="${h.id}">${h.hotel_name}</li>`));
  });

  $input.on('input', function(){
    const query = this.value.toLowerCase();
    $list.empty();
    hotels
      .filter(h => h.hotel_name.toLowerCase().includes(query))
      .forEach(h => $list.append(`<li class="list-group-item list-group-item-action" data-id="${h.id}">${h.hotel_name}</li>`));
    $list.toggle($list.children().length > 0);
  });

  $list.on('click', 'li', function(){
    $input.val($(this).text());
    $('#hotel_id').val($(this).data('id'));
    $list.hide();
  });

  $(document).on('click', e => {
    if (!$(e.target).closest('.mb-4').length) $list.hide();
  });
});

$(function () {
    $('#createRoomForm').on('submit', function (e) {
        e.preventDefault();
        console.log($(this).serialize());

        $.ajax({
            url: "<?= base_url('room/store') ?>",
            type: "POST",
            data: $(this).serialize(),
            dataType: "json",

            beforeSend: function () {
                $('button[type="submit"], input[type="submit"]').prop('disabled', true).text('Saving...');
            },

            success: function (response) {
                if (response.status === 'success') {
                    alert(response.message);
                    $('#createRoomForm')[0].reset();
                    $('#hotelSearch').val('');
                    $('#hotel_id').val('');
                } else {
                    alert(response.message);
                }
            },

            error: function (xhr) {
                alert('Server error!');
                console.log(xhr.responseText);
            },

            complete: function () {
                $('button[type="submit"], input[type="submit"]').prop('disabled', false).text('Create');
            }
        });
    });
});
</script>
