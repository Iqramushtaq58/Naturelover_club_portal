<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Us - Nature Lover Club</title>
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


  <!-- Contact Section -->
  <section class="py-5 bg-light">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="text-success">Contact Us</h2>
        <p class="text-muted">We’d love to hear from you! Whether you have a question about events, volunteering, or anything else.</p>
      </div>

      <div class="row g-5">
        <!-- Contact Form -->
        <div class="col-md-6">
          <form>
            <div class="mb-3">
              <label for="name" class="form-label">Your Name</label>
              <input type="text" class="form-control" id="name" placeholder="Full Name" required>
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Your Email</label>
              <input type="email" class="form-control" id="email" placeholder="example@email.com" required>
            </div>
            <div class="mb-3">
              <label for="message" class="form-label">Message</label>
              <textarea class="form-control" id="message" rows="5" placeholder="Type your message here..." required></textarea>
            </div>
            <button type="submit" class="btn btn-success w-100">Send Message</button>
          </form>
        </div>

        <!-- Contact Info -->
        <div class="col-md-6">
          <h5 class="text-success">Get In Touch</h5>
          <p><i class="bi bi-geo-alt-fill text-success me-2"></i> COMSATS University, Sahiwal Campus</p>
          <p><i class="bi bi-envelope-fill text-success me-2"></i> natureclub@comsats.edu.pk</p>
          <p><i class="bi bi-telephone-fill text-success me-2"></i> +92 300 1234567</p>

          <!-- Google Map -->
          <div class="mt-4">
            <div class="ratio ratio-16x9">
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3404.1644768394946!2d72.9408363145419!3d30.662011681648376!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x393d7dfb8394f309%3A0x35a4c2a3f6a3fc8f!2sCOMSATS%20University%20Islamabad%2C%20Sahiwal%20Campus!5e0!3m2!1sen!2s!4v1682954387612" style="border:0;" allowfullscreen></iframe>
            </div>
          </div>
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
