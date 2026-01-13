

<div class="main-content d-flex flex-column min-vh-100">
  <div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h5 class="fw-bold mb-0">Create New Discount</h5>
    </div>

    <div class="card card-custom w-100">
      <div class="card-body">

        <!-- Form Builder -->
        <?= form_open('#', ['id' => 'createDiscountForm']) ?>
        <?= csrf_field() ?>

        <!-- Discount Type -->
        <div class="mb-3">
          <?= form_label('Discount Type', 'discount_type', ['class' => 'form-label fw-bold']) ?>
          <?= form_input([
              'name' => 'discount_type',
              'id' => 'discount_type',
              'class' => 'form-control',
              'placeholder' => 'Enter discount type (e.g. Percentage or Flat)',
              'required' => true,
              'value' => old('discount_type')
          ]) ?>
        </div>

        <!-- Discount Name -->
        <div class="mb-3">
          <?= form_label('Discount Name', 'discount_name', ['class' => 'form-label fw-bold']) ?>
          <?= form_input([
              'name' => 'discount_name',
              'id' => 'discount_name',
              'class' => 'form-control',
              'placeholder' => 'Enter discount name (e.g. Summer Sale, New Year Offer)',
              'required' => true,
              'value' => old('discount_name')
          ]) ?>
        </div>

        <!-- Discount Value -->
        <div class="mb-3">
          <?= form_label('Discount Value', 'value', ['class' => 'form-label fw-bold']) ?>
          <?= form_input([
              'name' => 'value',
              'id' => 'value',
              'class' => 'form-control',
              'type' => 'number',
              'step' => '0.01',
              'placeholder' => 'Enter discount value (e.g. 10 or 1500.00)',
              'required' => true,
              'value' => old('value')
          ]) ?>
        </div>

        <!-- Start Date -->
        <div class="mb-3">
          <?= form_label('Start Date', 'start_date', ['class' => 'form-label fw-bold']) ?>
          <?= form_input([
              'name' => 'start_date',
              'id' => 'start_date',
              'class' => 'form-control',
              'type' => 'date',
              'required' => true,
              'value' => old('start_date')
          ]) ?>
        </div>

        <!-- End Date -->
        <div class="mb-3">
          <?= form_label('End Date', 'end_date', ['class' => 'form-label fw-bold']) ?>
          <?= form_input([
              'name' => 'end_date',
              'id' => 'end_date',
              'class' => 'form-control',
              'type' => 'date',
              'required' => true,
              'value' => old('end_date')
          ]) ?>
        </div>

        <!-- Status -->
        <div class="mb-3">
          <?= form_label('Status', 'status', ['class' => 'form-label fw-bold']) ?>
          <?= form_dropdown('status', [
              '' => 'Select Status',
              'Active' => 'Active',
              'Inactive' => 'Inactive'
          ], old('status'), ['id' => 'status', 'class' => 'form-select', 'required' => true]) ?>
        </div>

        <!-- Buttons -->
        <div class="d-flex gap-2">
          <button type="submit" id="createDiscountBtn" class="btn btn-success">Save Discount</button>
          <a href="<?= base_url('discount') ?>" class="btn btn-secondary btn-sm">← Back to List</a>
        </div>

        <?= form_close() ?>

      </div>
    </div>
  </div>
</div>



<script>
$(function() {
    $('#createDiscountForm').on('submit', function(e) {
        e.preventDefault();

        const form = $(this);
        const formData = form.serialize();

        console.log(formData);

        $.ajax({
            url: "<?= site_url('discount/store') ?>",
            type: "POST",
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('#createDiscountBtn').prop('disabled', true).text('Saving...');
            },
            success: function(response) {
                if(response.status === 'success') {
                    alert(response.message || 'Discount created successfully!');
                    form[0].reset();
                } else {
                    alert(response.message || 'Failed to create discount!');
                }
            },
            error: function(xhr) {
                alert('Server error!');
                console.error(xhr.responseText);
            },
            complete: function() {
                $('#createDiscountBtn').prop('disabled', false).text('Save Discount');
            }
        });
    });

});
</script>
