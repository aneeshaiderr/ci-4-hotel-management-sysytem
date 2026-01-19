<div class="main-content d-flex flex-column min-vh-100">
    <div class="container py-5">

        <!-- Page Heading -->
        <h5 class="fw-bold mb-2 ps-2">Service</h5>

        <!-- Create Service Button -->
        <div class="mb-4">
            <a href="<?= base_url('services/create') ?>" class="btn btn-sm btn-success">
                + Create Services
            </a>
        </div>

        <!-- Card -->
        <div class="card card-custom w-100">
            <div class="card-body">

                <h6 class="mb-3 fw-bold">Service List</h6>

                <table id="example" class="table table-striped table-bordered align-middle w-100">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Service Name</th>
                            <th>Price</th>
                            <th>Status</th>
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
$(document).ready(function () {

    $('#example').DataTable({
        processing: true,
        serverSide: true,
        pageLength: 5,
        lengthChange: false,

        ajax: {
            url: "<?= base_url('services') ?>",
            type: "POST"
        },

        columns: [
            { data: 'id' },
            { data: 'service_name' },
            {
                data: 'price',
                render: function (data) {
                    return '$' + data;
                }
            },
            {
                data: 'status',
                render: function (status) {
                    status = status.toLowerCase();
                    if (status === 'active') {
                        return '<span class="badge bg-success">Active</span>';
                    }
                    if (status === 'inactive') {
                        return '<span class="badge bg-danger">Inactive</span>';
                    }
                    return '<span class="badge bg-warning text-dark">' + status + '</span>';
                }
            },
            {
                data: 'id',
                orderable: false,
                searchable: false,
                render: function (id) {
                    return `
                        <div class="d-flex align-items-center gap-1">
                            <a href="<?= base_url('services/edit') ?>/${id}"
                               class="btn btn-sm btn-primary">
                                View
                            </a>

                            <form method="post"
                                  action="<?= base_url('services/delete') ?>"
                                  onsubmit="return confirm('Are you sure you want to delete this service?')"
                                  class="m-0">

                                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                                <input type="hidden" name="id" value="${id}">

                                <button type="submit"
                                        class="btn btn-sm btn-danger">
                                    Delete
                                </button>
                            </form>
                        </div>
                    `;
                }
            }
        ]
    });

});
</script>
