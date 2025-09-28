<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Nature Lover Club</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('app.css') }}">
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center" href="/">
      <img src="{{ asset('images/OIP.jpeg') }}" alt="Logo" width="40" height="40" class="me-2 rounded-circle">
      <span>Nature Lover</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
      data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
      aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav ms-auto">

        @if (session('admin_logged_in'))
          <!-- Admin Navbar -->
          <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
          <a class="nav-link" href="{{ route('admin.logout') }}">Logout</a>

        @elseif (Auth::check())
          <!-- Member Navbar -->
          <a class="nav-link" href="/">Home</a>
          <a class="nav-link" href="/about">About</a>
          <a class="nav-link" href="/events">Events</a>
          <a class="nav-link" href="/contact">Contact Us</a>
          <a class="nav-link" href="{{ route('profile.show') }}">Profile</a>
          <form action="{{ route('logout.user') }}" method="POST" class="d-inline">
            @csrf
            <button class="btn btn-link nav-link">Logout</button>
          </form>

        @else
          <!-- Guest Navbar -->
          <a class="nav-link active" href="/">Home</a>
          <a class="nav-link" href="/login">Login</a>
          <a class="nav-link" href="/register">Register</a>
          <a class="nav-link" href="/about">About</a>
          <a class="nav-link" href="/contact">Contact Us</a>
        @endif

      </div>
    </div>
  </div>
</nav>

<!-- Hero Section -->
<section class="hero text-white text-center d-flex align-items-center justify-content-center"
  style="height: 100vh; background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 100, 0, 0.5)), url('{{ asset('images/pexels-fox-58267-212324.jpg') }}') center center/cover no-repeat;">
  <div class="container animate__animated animate__fadeInDown">
    <h1 class="display-3 fw-bold">🌿 Welcome to Nature Lover Club</h1>
    <p class="lead">Connecting students with nature through sustainability and adventure.</p>
    <a href="{{ url('/about') }}" class="btn btn-success btn-lg mt-3 shadow-lg">Explore More</a>
  </div>
</section>

<!-- Sliding Notification -->
<marquee class="bg-success text-white py-2" behavior="scroll" direction="left">
  🌿 New Event: Tree Plantation Drive this Sunday! 🌿 | 🐾 Wildlife Photography Workshop - Register Now! 📸
</marquee>

<!-- Features Section -->
<section class="py-5 bg-white text-center">
  <div class="container">
    <h2 class="mb-4">Why Join Us?</h2>
    <div class="row">
      <div class="col-md-4">
        <i class="bi bi-tree-fill display-4 text-success"></i>
        <h4>Nature Trips</h4>
        <p>Explore the beauty of nature through guided trips and hikes.</p>
      </div>
      <div class="col-md-4">
        <i class="bi bi-camera-fill display-4 text-success"></i>
        <h4>Photography</h4>
        <p>Capture stunning landscapes and wildlife with our experts.</p>
      </div>
      <div class="col-md-4">
        <i class="bi bi-people-fill display-4 text-success"></i>
        <h4>Community</h4>
        <p>Connect with fellow nature lovers and make a difference.</p>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="bg-success text-white text-center py-3 mt-5">
  <p class="mb-0">&copy; 2025 Nature Lover Club | Designed by <strong> Iqra Mushtaq</strong></p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('script.js') }}"></script>

</body>
</html>
