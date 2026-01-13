<div class="main-content d-flex flex-column min-vh-100">
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold mb-0">Create New Hotel</h5>
        </div>

        <div class="card card-custom w-100">
            <div class="card-body">

                <!-- Form (CI4 Form Helper) -->
                <?= form_open('', ['id' => 'createHotelForm']) ?>
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <?= form_label('Hotel Name', 'hotel_name', ['class' => 'form-label fw-bold']) ?>
                        <?= form_input([
                            'name'        => 'hotel_name',
                            'id'          => 'hotel_name',
                            'class'       => 'form-control',
                            'placeholder' => 'Enter hotel name',
                            'required'    => true
                        ]) ?>
                    </div>

                    <div class="mb-3">
                        <?= form_label('Address', 'address', ['class' => 'form-label fw-bold']) ?>
                        <?= form_input([
                            'name'        => 'address',
                            'id'          => 'address',
                            'class'       => 'form-control',
                            'placeholder' => 'Enter address',
                            'required'    => true
                        ]) ?>
                    </div>

                    <div class="mb-3">
                        <?= form_label('Contact Number', 'contact_no', ['class' => 'form-label fw-bold']) ?>
                        <?= form_input([
                            'name'        => 'contact_no',
                            'id'          => 'contact_no',
                            'class'       => 'form-control',
                            'placeholder' => 'Enter contact number',
                            'required'    => true
                        ]) ?>
                    </div>

                    <?= form_submit('submit', 'Save Hotel', [
                        'class' => 'btn btn-success',
                        'id'    => 'saveHotelBtn'
                    ]) ?>

                    <a href="<?= base_url('hotel') ?>" class="btn btn-secondary btn-sm">
                        ← Back to List
                    </a>

                <?= form_close() ?>

            </div>
        </div>
    </div>
</div>

<script>
$(function () {

    $('#createHotelForm').on('submit', function (e) {
        e.preventDefault();

        console.log($(this).serialize());

        $.ajax({
            url: "<?= base_url('hotel/store') ?>",
            type: "POST",
            data: $(this).serialize(),
            dataType: "json",

            beforeSend: function () {
                $('#saveHotelBtn').prop('disabled', true).val('Saving...');
            },

            success: function (response) {
                if (response.status === 'success') {
                    alert(response.message);
                    $('#createHotelForm')[0].reset();
                } else {
                    alert(response.message || 'Failed to save hotel');
                }
            },

            error: function (xhr) {
                alert('Server error!');
                console.log(xhr.responseText);
            },

            complete: function () {
                $('#saveHotelBtn').prop('disabled', false).val('Save Hotel');
            }
        });
    });

});
</script>
