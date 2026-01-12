<div class="main-content d-flex flex-column min-vh-100">
  <div class="container py-5">
    <main>
      <div class="mx-auto" style="max-width: 700px;">

        <h5 class="fw-bold mb-4 text-primary">Update User</h5>

        <!-- Use CI4 Form Helper -->
        <?= form_open('', ['id' => 'updateUserForm']) ?>
        <?= csrf_field() ?>
        <?= form_hidden('id', esc($user['id'])) ?>

        <!-- Username -->
        <div class="mb-3">
          <?= form_label('Username', 'username') ?>
          <?= form_input([
            'name' => 'username',
            'id' => 'username',
            'value' => esc($user['username']),
            'class' => 'form-control',
            'required' => true
          ]) ?>
          <div class="invalid-feedback" id="error-username"></div>
        </div>

        <!-- First Name -->
        <div class="mb-3">
          <?= form_label('First Name', 'first_name') ?>
          <?= form_input([
            'name' => 'first_name',
            'id' => 'first_name',
            'value' => esc($user['first_name']),
            'class' => 'form-control',
            'required' => true
          ]) ?>
          <div class="invalid-feedback" id="error-first_name"></div>
        </div>

        <!-- Last Name -->
        <div class="mb-3">
          <?= form_label('Last Name', 'last_name') ?>
          <?= form_input([
            'name' => 'last_name',
            'id' => 'last_name',
            'value' => esc($user['last_name']),
            'class' => 'form-control',
            'required' => true
          ]) ?>
          <div class="invalid-feedback" id="error-last_name"></div>
        </div>

        <!-- Email -->
        <div class="mb-3">
          <?= form_label('Email', 'email') ?>
          <?= form_input([
            'name' => 'email',
            'id' => 'email',
            'type' => 'email',
            'value' => esc($user['email']),
            'class' => 'form-control',
            'required' => true
          ]) ?>
          <div class="invalid-feedback" id="error-email"></div>
        </div>

        <!-- Buttons -->
        <div class="d-flex justify-content-end gap-2 mt-3">
          <a href="<?= base_url('user') ?>" class="btn btn-secondary">Cancel</a>
          <?= form_button([
            'type' => 'submit',
            'id' => 'submitBtn',
            'class' => 'btn btn-success',
            'content' => 'Update'
          ]) ?>
        </div>

        <?= form_close() ?>

      </div>
    </main>
  </div>
</div>


<script>
$(document).ready(function() {
    $('#updateUserForm').on('submit', function(e) {
        e.preventDefault();

       const form = this;
         const formData = $(form).serialize();

        $.ajax({
            url: "<?= base_url('user/update') ?>",
            type: "POST",
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('#submitBtn').prop('disabled', true).text('Updating...');
            },
            success: function(response) {
                if(response.status === 'success') {
                    alert(response.message || 'User updated successfully!');
                    // Optionally redirect
                    window.location.href = "<?= base_url('user') ?>";
                } else if(response.status === 'validation') {
                    $.each(response.errors, function(field, message) {
                        $('#' + field).addClass('is-invalid');
                        $('#error-' + field).text(message);
                    });
                } else {
                    alert(response.message || 'Something went wrong!');
                }
            },
            error: function(xhr) {
                console.log(xhr.responseText);
                alert('Server error!');
            },
            complete: function() {
                $('#submitBtn').prop('disabled', false).text('Update');
            }
        });
    });
});
</script>
