
<div class="main-content d-flex flex-column min-vh-100">
  <div class="container py-5">
    <main>
      <div class="mx-auto max-w-4xl py-7 px-7">
        <h5 class="fw-bold mb-4">Edit Discount</h5>

        <?= form_open('#', ['id' => 'editDiscountForm']) ?>
        <?= csrf_field() ?>

        <?= form_hidden('id', $discount['id']) ?>

        <div class="mb-4">
          <?= form_label('Discount Type', 'discount_type', ['class' => 'form-label fw-bold']) ?>
          <?= form_dropdown('discount_type', [
                '' => 'Select Type',
                'percentage' => 'Percentage',
                'amount' => 'Amount'
            ], strtolower($discount['discount_type']), ['class' => 'form-control', 'id' => 'discount_type', 'required' => true]) ?>
        </div>

        <div class="mb-4">
          <?= form_label('Discount Name', 'discount_name', ['class' => 'form-label fw-bold']) ?>
          <?= form_input([
                'name' => 'discount_name',
                'id' => 'discount_name',
                'value' => $discount['discount_name'],
                'class' => 'form-control',
                'placeholder' => 'Enter discount name',
                'required' => true
            ]) ?>
        </div>

        <div class="mb-4">
          <?= form_label('Discount Value', 'value', ['class' => 'form-label fw-bold']) ?>
          <?= form_input([
                'type' => 'number',
                'step' => '0.01',
                'name' => 'value',
                'id' => 'value',
                'value' => $discount['value'],
                'class' => 'form-control',
                'placeholder' => 'Enter discount value',
                'required' => true
            ]) ?>
        </div>

        <!-- Start Date -->
        <div class="mb-4">
          <?= form_label('Start Date', 'start_date', ['class' => 'form-label fw-bold']) ?>
          <?= form_input([
                'type' => 'date',
                'name' => 'start_date',
                'id' => 'start_date',
                'value' => $discount['start_date'],
                'class' => 'form-control',
                'required' => true
            ]) ?>
        </div>

        <!-- End Date -->
        <div class="mb-4">
          <?= form_label('End Date', 'end_date', ['class' => 'form-label fw-bold']) ?>
          <?= form_input([
                'type' => 'date',
                'name' => 'end_date',
                'id' => 'end_date',
                'value' => $discount['end_date'],
                'class' => 'form-control',
                'required' => true
            ]) ?>
        </div>

        <!-- Status -->
        <div class="mb-4">
          <?= form_label('Status', 'status', ['class' => 'form-label fw-bold']) ?>
          <?= form_dropdown('status', [
                'active' => 'Active',
                'inactive' => 'Inactive'
            ], strtolower($discount['status']), ['class' => 'form-control', 'id' => 'status', 'required' => true]) ?>
        </div>

        <!-- Buttons -->
        <div class="mt-6 d-flex justify-content-end gap-2">
          <a href="<?= base_url('discount') ?>" class="btn btn-secondary">Back</a>
          <?= form_submit('submit', 'Update Discount', [
                'class' => 'btn btn-success',
                'id' => 'updateBtn',
                'style' => 'background-color:#16a34a;',
                'onmouseover' => "this.style.backgroundColor='#15803d'",
                'onmouseout' => "this.style.backgroundColor='#16a34a'"
            ]) ?>
        </div>

        <?= form_close() ?>
      </div>
    </main>
  </div>
</div>


<script>
$(function() {
    $('#editDiscountForm').on('submit', function(e) {
        e.preventDefault();

        var form = $(this);
        var formData = form.serialize();

        $.ajax({
            url: "<?= base_url('discount/update') ?>",
            type: "POST",
             data: $(this).serialize(),
            dataType: "json",

            beforeSend: function() {
                $('#updateBtn').prop('disabled', true).text('Updating...');
            },

            success: function(response) {
                if(response.status === 'success'){
                    alert(response.message);
                    window.location.href = "<?= base_url('discount') ?>";
                } else {
                    alert(response.message || 'Update failed!');
                }
            },

            error: function(xhr){
                console.error(xhr.responseText);
                alert('Server Error!');
            },

            complete: function(){
                $('#updateBtn').prop('disabled', false).text('Update Discount');
            }
        });
    });
});
</script>
