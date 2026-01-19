<div class="main-content d-flex flex-column min-vh-100">
    <div class="container py-5">

        <h5 class="ps-2">Users</h5>

        <div class="mb-3">
            <a href="<?= base_url('user/create') ?>" class="btn btn-sm btn-success">+ Create User</a>
        </div>

        <div class="row g-3 align-items-start">
            <!-- Users Table Column -->
            <div class="col-lg-8 col-md-7">
                <div class="card w-100">
                    <div class="card-body">
                        <h6 class="mb-3">Users List</h6>
                        <div class="table-responsive">
                            <table id="usersTable" class="table table-striped table-bordered align-middle w-100">
                                <thead class="table-light">
                                    <tr>
                                        <th>Username</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Column -->
            <div class="col-lg-4 col-md-5">
                <div class="card text-center w-100 profile-outer-card">
                    <div class="card-body profile-inner-card-body">
                        <h1 class="h5 mb-2">Angelica Ramos</h1>
                        <img src="img/avatar-3.jpg" class="userprofile-pic mb-3" alt="Profile picture">

                        <div class="mb-3 text-start">
                            <h2 class="h6 mb-1">About me</h2>
                            <p class="small text-muted profile-text-ellipsis">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                            </p>
                        </div>

                        <div class="mb-3 text-start profile-info-container">
                            <div class="d-flex py-1 profile-info-row">
                                <div class="flex-shrink-0 text-muted small fw-bold w-50">Name</div>
                                <div class="flex-grow-1 small profile-text-ellipsis ms-1">Angelica Ramos</div>
                            </div>
                            <div class="d-flex py-1 profile-info-row">
                                <div class="flex-shrink-0 text-muted small fw-bold w-50">Company</div>
                                <div class="flex-grow-1 small profile-text-ellipsis ms-1">The Wiz</div>
                            </div>
                            <div class="d-flex py-1 profile-info-row">
                                <div class="flex-shrink-0 text-muted small fw-bold w-50">Email</div>
                                <div class="flex-grow-1 small profile-text-ellipsis ms-1">angelica@ramos.com</div>
                            </div>
                            <div class="d-flex py-1 profile-info-row">
                                <div class="flex-shrink-0 text-muted small fw-bold w-50">Phone</div>
                                <div class="flex-grow-1 small profile-text-ellipsis ms-1">+1234123123123</div>
                            </div>
                            <div class="d-flex align-items-center py-1 profile-info-row">
                                <div class="flex-shrink-0 text-muted small fw-bold w-50">Status</div>
                                <span class="badge bg-success ms-1">Active</span>
                            </div>
                        </div>

                        <div class="userprofile-activity-container mb-2 text-start">
                            <h2 class="h6 mb-3">Activity</h2>
                            <div class="d-flex mb-3">
                                <div class="userprofile-activity-dot me-3 mt-1"></div>
                                <div>
                                    <div class="d-flex justify-content-between align-items-baseline">
                                        <span class="fw-semibold">Signed out</span>
                                        <small class="text-muted">30m ago</small>
                                    </div>
                                    <p class="small text-muted mb-0">Nam pretium turpis et arcu. Duis arcu tortor, suscipit...</p>
                                </div>
                            </div>
                            <div class="d-flex mb-3">
                                <div class="userprofile-activity-dot me-3 mt-1"></div>
                                <div>
                                    <div class="d-flex justify-content-between align-items-baseline">
                                        <span class="fw-semibold">Created invoice #1204</span>
                                        <small class="text-muted">2h ago</small>
                                    </div>
                                    <p class="small text-muted mb-0">Sed aliquam ultrices mauris. Integer ante arcu...</p>
                                </div>
                            </div>
                            <div class="d-flex mb-3">
                                <div class="userprofile-activity-dot me-3 mt-1"></div>
                                <div>
                                    <div class="d-flex justify-content-between align-items-baseline">
                                        <span class="fw-semibold">Discarded invoice #1147</span>
                                        <small class="text-muted">3h ago</small>
                                    </div>
                                    <p class="small text-muted mb-0">Nam pretium turpis et arcu. Duis arcu tortor, suscipit...</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
$(document).ready(function () {
    $('#usersTable').DataTable({
        processing: true,
        serverSide: true,
        lengthChange: false,
        pageLength: 2,
        ajax: {
            url: "<?= base_url('user') ?>",
            type: "POST"
        },
        columns: [
            { data: 'username' },
            { data: 'first_name' },
            { data: 'last_name' },
            { data: 'email' },
            {
                data: 'id',
                orderable: false,
                render: function (id) {
                    return `
                        <div class="d-flex">
                            <a href="<?= base_url('user/edit') ?>/${id}" class="btn btn-sm btn-primary me-1">View</a>
                            <form class="d-inline delete-form m-0" method="post" action="<?= base_url('user/delete') ?>">
                                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">
                                <input type="hidden" name="id" value="${id}">
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                    `;
                }
            }
        ]
    });
});
</script>
