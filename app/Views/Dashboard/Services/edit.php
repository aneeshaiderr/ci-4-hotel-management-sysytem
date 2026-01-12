<div class="main-content d-flex flex-column min-vh-100">
    <div class="container py-5">
        <main>
            <div class="mx-auto max-w-4xl py-7 px-7">
                <h5 class="fw-bold mb-4">Edit Service</h5>

                <!-- Form Builder in CI4 -->
                <?= form_open('#', ['id' => 'editServiceForm']) ?>
                <?= csrf_field() ?>

                <?= form_hidden('id', esc($service['id'])) ?>

                <!-- Service Name -->
                <div class="mb-4">
                    <?= form_label('Service Name', 'service_name', ['class' => 'form-label fw-bold']) ?>
                    <?= form_input([
                        'name' => 'service_name',
                        'id' => 'service_name',
                        'class' => 'form-control',
                        'placeholder' => 'Enter service name',
                        'required' => true,
                        'value' => esc($service['service_name'])
                    ]) ?>
                </div>

                <!-- Price -->
                <div class="mb-4">
                    <?= form_label('Price', 'price', ['class' => 'form-label fw-bold']) ?>
                    <?= form_input([
                        'name' => 'price',
                        'id' => 'price',
                        'class' => 'form-control',
                        'type' => 'number',
                        'step' => '0.01',
                        'placeholder' => 'Enter price',
                        'required' => true,
                        'value' => esc($service['price'])
                    ]) ?>
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <?= form_label('Status', 'status', ['class' => 'form-label fw-bold']) ?>
                    <?= form_dropdown('status', [
                        '' => 'Select Status',
                        'active' => 'Active',
                        'inactive' => 'Inactive'
                    ], strtolower($service['status']), ['id' => 'status', 'class' => 'form-select', 'required' => true]) ?>
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-end gap-3">
                    <a href="<?= base_url('services') ?>" class="btn btn-secondary">Back</a>
                    <button type="submit" id="updateServiceBtn" class="btn btn-success"
                            style="background-color:#16a34a;"
                            onmouseover="this.style.backgroundColor='#15803d'"
                            onmouseout="this.style.backgroundColor='#16a34a'">
                        Update Service
                    </button>
                </div>

                <?= form_close() ?>
            </div>
        </main>
    </div>
</div>



<script>
$(function() {

    $('#editServiceForm').on('submit', function(e) {
        e.preventDefault();

        const form = $(this);
        const formData = form.serialize();

        console.log(formData);

        $.ajax({
            url: "<?= base_url('services/update') ?>",
            type: "POST",
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('#updateServiceBtn').prop('disabled', true).text('Updating...');
            },
            success: function(response) {
                if (response.status === 'success') {
                    alert(response.message || 'Service updated successfully!');

                    window.location.href = "<?= base_url('services') ?>";
                } else {
                    alert(response.message || 'Update failed!');
                }
            },
            error: function(xhr) {
                alert('Server error!');
                console.error(xhr.responseText);
            },
            complete: function() {
                $('#updateServiceBtn').prop('disabled', false).text('Update Service');
            }
        });
    });

});
</script>
