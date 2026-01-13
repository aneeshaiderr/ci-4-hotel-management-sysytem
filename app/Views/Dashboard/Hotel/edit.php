<div class="main-content d-flex flex-column min-vh-100">
  <div class="container py-5">
    <main>
      <div class="mx-auto max-w-4xl py-7 px-7">
        <h5 class="fw-bold mb-4">Edit Hotel</h5>

        <?= form_open('', ['id' => 'editHotelForm']) ?>
          <?= csrf_field() ?>

          <!-- Hidden ID -->
          <?= form_hidden('id', esc($hotel['id'])) ?>

          <!-- Hotel Name -->
          <div class="mb-4">
            <?= form_label('Hotel Name', 'hotel_name', ['class' => 'form-label fw-bold']) ?>
            <?= form_input([
                'type'     => 'text',
                'id'       => 'hotel_name',
                'name'     => 'hotel_name',
                'value'    => esc($hotel['hotel_name']),
                'required' => true,
                'class'    => 'form-control'
            ]) ?>
          </div>

          <!-- Address -->
          <div class="mb-4">
            <?= form_label('Address', 'address', ['class' => 'form-label fw-bold']) ?>
            <?= form_textarea([
                'id'       => 'address',
                'name'     => 'address',
                'value'    => esc($hotel['address']),
                'required' => true,
                'class'    => 'form-control'
            ]) ?>
          </div>

          <!-- Contact Number -->
          <div class="mb-4">
            <?= form_label('Contact No', 'contact_no', ['class' => 'form-label fw-bold']) ?>
            <?= form_input([
                'type'     => 'text',
                'id'       => 'contact_no',
                'name'     => 'contact_no',
                'value'    => esc($hotel['contact_no']),
                'required' => true,
                'class'    => 'form-control'
            ]) ?>
          </div>

          <!-- Buttons -->
          <div class="mt-6 d-flex justify-content-end gap-2">
            <a href="<?= base_url('hotel') ?>" class="btn btn-secondary">Cancel</a>

            <?= form_submit('submit', 'Update', [
                'id'    => 'updateBtn',
                'class' => 'btn btn-success',
                'style' => 'background-color:#16a34a; color:white;',
                'onmouseover' => "this.style.backgroundColor='#15803d'",
                'onmouseout'  => "this.style.backgroundColor='#16a34a'"
            ]) ?>
          </div>

        <?= form_close() ?>
      </div>
    </main>
  </div>
</div>

<script>
$(function () {

    $('#editHotelForm').on('submit', function (e) {
        e.preventDefault();

        const form = this;
        const formData = $(form).serialize();

        console.log(formData);

        $.ajax({
            url: "<?= base_url('hotel/update') ?>",
            type: "POST",
            data: formData,
            dataType: "json",
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },

            beforeSend: function () {
                $(form).find('button[type="submit"], input[type="submit"]')
                       .prop('disabled', true)
                       .val('Updating...')
                       .text('Updating...');
            },

            success: function (response) {
                if (response.status === 'success') {
                    alert(response.message || 'Hotel updated successfully!');
                    window.location.href = "<?= base_url('hotel') ?>";
                } else {
                    alert(response.message || 'Update failed!');
                }
            },

            error: function (xhr) {
                alert('Server error!');
                console.log(xhr.responseText);
            },

            complete: function () {
                $(form).find('button[type="submit"], input[type="submit"]')
                       .prop('disabled', false)
                       .val('Update')
                       .text('Update');
            }
        });
    });

});
</script>
