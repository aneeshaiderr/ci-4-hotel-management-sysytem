<?php
use CodeIgniter\Shield\Authentication\Authentication;

// Get the Auth instance
$auth = auth(); // this is the global helper in Shield

// Initialize
$userGroups = [];
$currentUser = null;

// Check if a user is logged in
if ($user = $auth->user()) {
    $currentUser = $user;
    $userGroups = $user->getGroups(); // array of group names
}

?>

<div class="content-wrapper">

  <aside id="sidebar" class="text-white vh-100 p-3">
    <!-- Sidebar Brand -->
    <div class="text-center mb-4">
      <h5 class="fw-bold">Hotel Reservation</h5>
    </div>

    <!-- User Profile Section -->
    <div class="text-center mb-3">
      <img src="<?= base_url('assets_dashboard/img/avatar.jpg') ?>" class="rounded-circle img-fluid mb-2" alt="User Avatar" style="width:80px; height:80px;">
      <div class="mb-0">
        <small class="text-secondary mb-0">
            <?php if (in_array('super-admin', $userGroups)) : ?>
                Super Admin
            <?php elseif (in_array('staff', $userGroups)) : ?>
                Staff
            <?php elseif (in_array('user', $userGroups)) : ?>
                User
            <?php else : ?>
                Guest
            <?php endif; ?>
        </small>
      </div>
    </div>

    <hr class="border-secondary">

    <!-- Sidebar Navigation -->
    <ul class="nav flex-column">

      <!-- Dashboards -->
      <?php if (in_array('super-admin', $userGroups)) : ?>
      <li class="nav-item">
        <a class="nav-link text-white" data-bs-toggle="collapse" href="#dashboards" role="button" aria-expanded="false" aria-controls="dashboards">
          <i class="fas fa-sliders-h"></i> Dashboards
        </a>
        <div class="collapse" id="dashboards">
          <ul class="nav flex-column ms-3">
            <li class="nav-item"><a href="<?= base_url('analytics') ?>" class="nav-link text-white <?= uri_string() === 'analytics' ? 'active bg-dark text-white' : '' ?>">Analytics</a></li>
            <li class="nav-item"><a href="<?= base_url('setting') ?>" class="nav-link text-white <?= uri_string() === 'setting' ? 'active bg-dark text-white' : '' ?>">Settings</a></li>
          </ul>
        </div>
      </li>
      <?php endif; ?>

      <!-- Pages -->
      <li class="nav-item">
        <a class="nav-link text-white" data-bs-toggle="collapse" href="#pages" role="button" aria-expanded="false" aria-controls="pages">
          <i class="fas fa-th-large"></i> Pages
        </a>
        <div class="collapse" id="pages">
          <ul class="nav flex-column ms-3">
            <?php if (in_array('super-admin', $userGroups)) : ?>
              <li class="nav-item"><a href="<?= base_url('user') ?>" class="nav-link text-white <?= uri_string() === 'user' ? 'active bg-dark text-white' : '' ?>">Users</a></li>
              <li class="nav-item"><a href="<?= base_url('hotel') ?>" class="nav-link text-white <?= uri_string() === 'hotel' ? 'active bg-dark text-white' : '' ?>">Hotels</a></li>
              <li class="nav-item"><a href="<?= base_url('rooms') ?>" class="nav-link text-white <?= uri_string() === 'rooms' ? 'active bg-dark text-white' : '' ?>">Rooms</a></li>
              <li class="nav-item"><a href="<?= base_url('services') ?>" class="nav-link text-white <?= uri_string() === 'services' ? 'active bg-dark text-white' : '' ?>">Services</a></li>
              <li class="nav-item"><a href="<?= base_url('discount') ?>" class="nav-link text-white <?= uri_string() === 'discount' ? 'active bg-dark text-white' : '' ?>">Discounts</a></li>
              <li class="nav-item"><a href="<?= base_url('reservation') ?>" class="nav-link text-white <?= uri_string() === 'reservation' ? 'active bg-dark text-white' : '' ?>">Reservations</a></li>
              <li class="nav-item"><a href="<?= base_url('payment') ?>" class="nav-link text-white <?= uri_string() === 'payment' ? 'active bg-dark text-white' : '' ?>">Payments</a></li>
              <li class="nav-item"><a href="<?= base_url('permission') ?>" class="nav-link text-white <?= uri_string() === 'permission' ? 'active bg-dark text-white' : '' ?>">Permissions</a></li>

            <?php elseif (in_array('staff', $userGroups)) : ?>
              <li class="nav-item"><a href="<?= base_url('user') ?>" class="nav-link text-white <?= uri_string() === 'user' ? 'active bg-dark text-white' : '' ?>">Users</a></li>
              <li class="nav-item"><a href="<?= base_url('reservation') ?>" class="nav-link text-white <?= uri_string() === 'reservation' ? 'active bg-dark text-white' : '' ?>">Reservations</a></li>
              <li class="nav-item"><a href="<?= base_url('services') ?>" class="nav-link text-white <?= uri_string() === 'services' ? 'active bg-dark text-white' : '' ?>">Services</a></li>
              <li class="nav-item"><a href="<?= base_url('rooms') ?>" class="nav-link text-white <?= uri_string() === 'rooms' ? 'active bg-dark text-white' : '' ?>">Rooms</a></li>
              <li class="nav-item"><a href="<?= base_url('discount') ?>" class="nav-link text-white <?= uri_string() === 'discount' ? 'active bg-dark text-white' : '' ?>">Discounts</a></li>

            <?php elseif (in_array('user', $userGroups)) : ?>
              <li class="nav-item"><a href="<?= base_url('user') ?>" class="nav-link text-white <?= uri_string() === 'user' ? 'active bg-dark text-white' : '' ?>">My Profile</a></li>
              <li class="nav-item"><a href="<?= base_url('reservation') ?>" class="nav-link text-white <?= uri_string() === 'reservation' ? 'active bg-dark text-white' : '' ?>">My Reservations</a></li>

            <?php else : ?>
              <li class="nav-item"><a href="<?= base_url('login') ?>" class="nav-link text-white">Login</a></li>
            <?php endif; ?>
          </ul>
        </div>
      </li>

    </ul>
  </aside>

</div>
