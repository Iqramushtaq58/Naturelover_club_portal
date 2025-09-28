<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>About - Nature Lover Club</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="{{ asset('style.css') }}">
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
            <button type="submit" class="btn btn-link nav-link">Logout</button>
          </form>

        @else
          <!-- Guest Navbar -->
          <a class="nav-link" href="/">Home</a>
          <a class="nav-link" href="/login">Login</a>
          <a class="nav-link" href="/register">Register</a>
          <a class="nav-link" href="/about">About</a>
          <a class="nav-link" href="/contact">Contact Us</a>
        @endif

      </div>
    </div>
  </div>
</nav>


  <!-- About Section -->
  <section class="py-5 bg-light">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="text-success">About Nature Lover Club</h2>
        <p class="text-muted">We are a community dedicated to promoting nature, conservation, and sustainable living.</p>
      </div>
      <div class="row align-items-center">
        <div class="col-md-6">
          <img src="{{ asset('images/bosnia-8410601_1920.jpg') }}" class="img-fluid rounded shadow" alt="About Nature">
        </div>
        <div class="col-md-6">
          <h4 class="text-success">Our Mission</h4>
          <p>
            To inspire individuals to connect with nature and to take action toward protecting our planet.
            We organize events, awareness campaigns, and eco-friendly projects that promote a healthy environment.
            Organize tree plantation, recycling, and clean-up drives across campus and in local communities.
            Provide volunteering and leadership opportunities for students passionate about sustainability.
          </p>

          <h4 class="text-success mt-4">Our Vision</h4>
          <p>
            A world where every person values and preserves nature for current and future generations. Together, we can make a difference.
         To inspire students to build a greener, cleaner, and more eco-conscious campus by connecting with nature and encouraging sustainable practices in daily life. </p>
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
  <!-- Custom JS -->
  <script src="{{ asset('script.js') }}"></script>

</body>
</html>
