<!-- HEADER SECTION START -->
<header>

  <!-- Top Bar -->
  <div class="bg-white border-bottom py-2 topbar-hide">
    <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center text-center text-md-start gap-2">

      <!-- Contact -->
      <ul class="list-unstyled d-flex flex-column flex-md-row mb-0 gap-2 gap-md-4 fw-medium topbar-list">
        <li><i class="fa fa-phone me-2 text-warning"></i> (12) 345 67890</li>
        <li><i class="fa fa-envelope me-2 text-warning"></i> info.colorlib@gmail.com</li>
      </ul>

      <!-- Social + Buttons -->
      <div class="d-flex align-items-center gap-2">
        <div class="social-icons d-flex">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
        </div>

        <a href="<?= base_url('booking') ?>" class="bk-btn text-center">Booking Now</a>
        <a href="<?= base_url('register') ?>" class="bk-btn text-center">Signup Now</a>
        <a href="<?= base_url('login') ?>" class="bk-btn text-center">Login</a>
      </div>
    </div>
  </div>

  <!-- Main Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">
    <div class="container">

      <!-- Logo -->
      <a class="navbar-brand" href="<?= base_url('/') ?>">
        <img src="<?= base_url('assets_front/images/logo.png') ?>" alt="Sona Hotel" style="height:40px;">
      </a>

      <!-- Toggler -->
      <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Menu -->
      <div class="collapse navbar-collapse custom-sidebar" id="mainNav">

        <button class="sidebar-close" data-bs-toggle="collapse" data-bs-target="#mainNav">&times;</button>

        <a href="<?= base_url('booking') ?>" class="bk-btn btn text-center mb-3">Booking Now</a>

        <ul class="navbar-nav ms-auto align-items-start gap-4 p-4">

          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('/') ?>">Home</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('room') ?>">Rooms</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('about') ?>">About Us</a>
          </li>

          <!-- Dropdown -->
          <li class="nav-item dropdown hover-dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button">
              Pages
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="<?= base_url('room-details') ?>">Room Details</a></li>
              <li><a class="dropdown-item" href="<?= base_url('blog-details') ?>">Blog Details</a></li>
              <li><a class="dropdown-item" href="#">Family Room</a></li>
              <li><a class="dropdown-item" href="#">Premium Room</a></li>
            </ul>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('news') ?>">News</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?= base_url('contact') ?>">Contact</a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link search-btn">
              <i class="fas fa-search"></i>
            </a>
          </li>

        </ul>
      </div>
    </div>
  </nav>
</header>

<!-- Search Overlay -->
<div class="search-overlay" id="searchOverlay">
  <span class="close-btn" id="closeSearch">&times;</span>
  <input type="text" placeholder="Search here..." />
</div>
