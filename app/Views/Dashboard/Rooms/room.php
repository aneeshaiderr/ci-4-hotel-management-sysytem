<div class="main-content d-flex flex-column min-vh-100">
  <div class="container py-5">
    <h5 class="fw-bold mb-2 mt-7 ps-2">Room</h5>

    <div class="mb-2">
      <a href="<?= base_url('room/create') ?>"
         class="btn btn-sm btn-success"
         style="background-color:#16a34a; color:white;">
         + Create Room
      </a>
    </div>

    <div class="card card-custom w-100">
      <div class="card-body">
        <h6 class="mb-3 fw-bold">Room List</h6>

        <table id="example" class="table table-striped table-bordered align-middle">
          <thead class="table-light">
            <tr>
              <th>ID</th>
              <th>Room #</th>
              <th>Floor</th>
              <th>Beds</th>
              <th>Guests</th>
              <th >Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>

      </div>
    </div>
  </div>
</div>

<script>
$(function () {

  const table = $('#example').DataTable({
    processing: true,
    serverSide: true,
    pageLength: 5,
    lengthChange: false,

    ajax: {
      url: "<?= base_url('rooms') ?>",
      type: "POST"
    },

    columns: [
      { data: 'id' },
      { data: 'room_number' },
      { data: 'floor' },
      { data: 'beds' },
      { data: 'max_guests' },

      // STATUS DROPDOWN
      {
        data: 'status',
        render: function (data, type, row) {
          return `
            <select class="form-select form-select-sm room-status"
                    data-id="${row.id}">
              <option value="available" ${data === 'available' ? 'selected' : ''}>Available</option>
              <option value="booked" ${data === 'booked' ? 'selected' : ''}>Booked</option>
              <option value="maintenance" ${data === 'maintenance' ? 'selected' : ''}>Maintenance</option>
            </select>
          `;
        }
      },

      // ACTIONS
      {
        data: 'id',
        render: function (id) {
          return `
            <a href="<?= base_url('room/edit') ?>/${id}"
               class="btn btn-sm btn-success">View</a>

            <form class="delete-form d-inline"
                  action="<?= base_url('room/delete') ?>"
                  method="post">

              <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
              <input type="hidden" name="id" value="${id}">

              <button type="submit" class="btn btn-sm btn-danger">
                Delete
              </button>
            </form>
          `;
        }
      }
    ]
  });

  // STATUS CHANGE AJAX
  $(document).on('change', '.room-status', function () {
    const roomId = $(this).data('id');
    const status = $(this).val();

    $.ajax({
      url: "<?= base_url('room') ?>",
      type: "POST",
      data: {
        id: roomId,
        status: status,
        <?= csrf_token() ?>: "<?= csrf_hash() ?>"
      },
      success: function () {
        table.ajax.reload(null, false);
      },
      error: function () {
        alert('Status update failed');
      }
    });
  });

});
</script>
