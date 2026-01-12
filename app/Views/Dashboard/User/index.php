
<div class="main-content d-flex flex-column min-vh-100">

    <!-- User Heading -->
    <div class="container py-5">
        <h5 class="ps-2">Users</h5>

        <!-- Create Button -->
        <div class="mb-3">
            <a href="<?= base_url('user/create') ?>" class="btn btn-sm btn-success">+ Create User</a>
        </div>

        <div class="row g-3 align-items-start">
            <!-- DataTable Column -->
            <div class="col-lg-8 col-md-7">
                <div class="card w-100">
                    <div class="card-body">
                        <h6 class="mb-3">Users List</h6>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered align-middle">
                                <thead class="table-light">
                                    <tr>

                                        <th>Username</th>
                                        <th>first_name</th>
                                        <th>last_name</th>
                                        <th>email</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($users)) : ?>
                                        <?php foreach($users as $user) : ?>
                                            <tr>
                                               <td><?= esc($user['username']) ?></td>
                                               <td> <?= isset($user['first_name']) ? esc($user['first_name']) : '' ?></td>
                                                <td><?= esc($user['last_name']) ?></td>



                                                <td><?= isset($user['email']) ? esc($user['email']) : '' ?></td>

                                                <td>
                                                    <div class="d-flex gap-1">
                                                   <a href="<?= base_url('user/edit/' . $user['id']) ?>" class="btn btn-sm btn-primary">
    Edit
</a>
                                                    <!-- Delete Button (uses POST form) -->
<form action="<?= base_url('user/delete') ?>" method="post" style="display:inline-block;"
      onsubmit="return confirm('Are you sure you want to delete this user?');">
    <?= csrf_field() ?>
    <input type="hidden" name="id" value="<?= esc($user['id']) ?>">
    <button type="submit" class="btn btn-sm btn-danger">
        Delete
    </button>
</form>                                    </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="7" class="text-center">No users found.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
      <!-- Profile Column -->
      <div class="col profile-column d-flex justify-content-end">
        <div class="card text-center w-100 profile-outer-card">
          <div class="card-body profile-inner-card-body">
            <h1 class="h5 mb-2">Angelica Ramos</h1>
            <img src="img/avatar-3.jpg" class="userprofile-pic" alt="Profile picture">
            <div class="mb-3 text-start mt-3">
              <h2 class="h6 mb-1">About me</h2>
              <p class="small text-muted profile-text-ellipsis">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
              </p>
            </div>
            <div class="mb-3 text-start profile-info-container">
              <div class="d-flex py-1 profile-info-row">
                <div class="flex-shrink-0 text-muted small fw-bold w-50">Name</div>
                <div class="flex-grow-1 small profile-text-ellipsis" style="margin-left:3px;">Angelica Ramos</div>
              </div>
              <div class="d-flex py-1 profile-info-row">
                <div class="flex-shrink-0 text-muted small fw-bold w-50">Company</div>
                <div class="flex-grow-1 small profile-text-ellipsis" style="margin-left:3px;">The Wiz</div>
              </div>
              <div class="d-flex py-1 profile-info-row">
                <div class="flex-shrink-0 text-muted small fw-bold w-50">Email</div>
                <div class="flex-grow-1 small profile-text-ellipsis" style="margin-left:3px;">angelica@ramos.com</div>
              </div>
              <div class="d-flex py-1 profile-info-row">
                <div class="flex-shrink-0 text-muted small fw-bold w-50">Phone</div>
                <div class="flex-grow-1 small profile-text-ellipsis" style="margin-left:3px;">+1234123123123</div>
              </div>
              <div class="d-flex align-items-center py-1 profile-info-row">
                <div class="flex-shrink-0 text-muted small fw-bold w-50">Status</div>
                <span class="badge bg-success" style="margin-left:3px;">Active</span>
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
                  <p class="small text-muted profile-text-ellipsis mb-0">
                    Nam pretium turpis et arcu. Duis arcu tortor, suscipit...
                  </p>
                </div>
              </div>
              <div class="d-flex mb-3">
                <div class="userprofile-activity-dot me-3 mt-1"></div>
                <div>
                  <div class="d-flex justify-content-between align-items-baseline">
                    <span class="fw-semibold">Created invoice #1204</span>
                    <small class="text-muted">2h ago</small>
                  </div>
                  <p class="small text-muted profile-text-ellipsis mb-0">
                    Sed aliquam ultrices mauris. Integer ante arcu...
                  </p>
                </div>
              </div>
              <div class="d-flex mb-3">
                <div class="userprofile-activity-dot me-3 mt-1"></div>
                <div>
                  <div class="d-flex justify-content-between align-items-baseline">
                    <span class="fw-semibold">Discarded invoice #1147</span>
                    <small class="text-muted">3h ago</small>
                  </div>
                  <p class="small text-muted profile-text-ellipsis mb-0">
                    Nam pretium turpis et arcu. Duis arcu tortor, suscipit...
                  </p>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
 </div>
 </div>

</div>

<!-- Hidden Delete Form -->
<form id="deleteForm" method="POST" action="<?= base_url('user/softDelete') ?>" style="display:none;">
    <?= csrf_field() ?>
    <input type="hidden" name="_method" value="DELETE">
    <input type="hidden" name="id" id="deleteId">
</form>

<script>
function submitDelete(id) {
    if(confirm('Are you sure you want to delete this user?')) {
        document.getElementById('deleteId').value = id;
        document.getElementById('deleteForm').submit();
    }
}

document.addEventListener('DOMContentLoaded', function() {

    const container = document.querySelector('.mb-3');

    if(container) {

        const helloBtn = document.createElement('button');


        helloBtn.textContent = 'Say ';
        helloBtn.className = 'btn btn-sm btn-info ms-2';


        helloBtn.addEventListener('click', function() {
            alert('Hello');
        });


        container.appendChild(helloBtn);
    }
});
</script>
