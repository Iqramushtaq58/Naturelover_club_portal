<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Events - Nature Lover Club</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('style.css') }}">

  <style>
    .event-img {
      height: 200px;
      width: 100%;
      object-fit: cover;
      border-top-left-radius: 0.5rem;
      border-top-right-radius: 0.5rem;
    }
  </style>
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
          <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
          <a class="nav-link" href="{{ route('admin.logout') }}">Logout</a>
        @elseif (Auth::check())
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

<!-- Events Section -->
<section class="py-5 bg-light">
  <div class="container">

    @if(session('success'))
      <div class="alert alert-success text-center">
        {{ session('success') }}
      </div>
    @endif

    <div class="text-center mb-5">
      <h2 class="text-success">Upcoming Events</h2>
      <p class="text-muted">Join us in celebrating and protecting nature through exciting events.</p>
    </div>

    <div class="row g-4">
      @foreach ($events as $event)
        <div class="col-md-4">
          <div class="card shadow-sm">
            <img src="{{ asset('uploads/' . $event->image) }}" class="card-img-top event-img" alt="{{ $event->title }}">
            <div class="card-body">
              <h5 class="card-title text-success">{{ $event->title }}</h5>
              <p class="card-text">{{ $event->description }}</p>
              <p class="text-muted"><i class="bi bi-calendar-event"></i> {{ $event->event_date }}</p>

              @auth
                @if(in_array($event->id, $joinedEventIds))
                  <div class="text-muted mt-2">
                    <i class="bi bi-check-circle-fill text-success"></i> You’ve already joined
                  </div>
                @else
                  <form action="{{ route('events.join', $event->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success mt-2">Join Event</button>
                  </form>
                @endif
              @else
                <div class="text-danger mt-2">Please login to join</div>
              @endauth

            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

<!-- Videos Section -->
<section class="py-5 bg-white">
  <div class="container">
    <div class="text-center mb-4">
      <h2 class="text-success">Watch Our Event Videos</h2>
      <p class="text-muted">Relive the moments and get inspired by our previous events.</p>
    </div>
    <div class="row g-4 justify-content-center">
      <div class="col-md-6">
        <div class="ratio ratio-16x9">
          <iframe width="560" height="315" src="https://www.youtube.com/embed/DAdIlcV8Tg8?si=jfd2mXse0yWytLDQ"
            frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media;
            gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>
      </div>
      <div class="col-md-6">
        <div class="ratio ratio-16x9">
          <iframe width="560" height="315" src="https://www.youtube.com/embed/CHSnz0bCaUk?si=0W9Kne2v1mzCqXlM"
            frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media;
            gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="bg-success text-white text-center py-3 mt-5">
  <p class="mb-0">&copy; 2025 Nature Lover Club | Designed by <strong> Iqra Mushtaq</strong></p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('script.js') }}"></script>
</body>
</html>
