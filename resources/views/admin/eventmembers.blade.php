<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Event Members - Nature Lover Club</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('style.css') }}">
  <style>
    .member-badge {
      background-color: #198754;
      padding: 3px 8px;
      color: white;
      border-radius: 12px;
      font-size: 0.85rem;
    }
  </style>
</head>
<body>

<!-- Admin Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center" href="/admin/dashboard">
      <img src="{{ asset('images/OIP.jpeg') }}" alt="Logo" width="40" height="40" class="me-2 rounded-circle">
      <span>Nature Lover</span>
    </a>
    <div class="collapse navbar-collapse">
      <div class="navbar-nav ms-auto">
        <a class="nav-link text-white" href="{{ route('admin.dashboard') }}">Dashboard</a>
        <a class="nav-link text-white" href="{{ route('admin.members') }}">Members</a>
        <a class="nav-link text-white" href="{{ route('admin.events') }}">Events</a>
        <a class="nav-link text-white active" href="{{ route('admin.event.members') }}">Event Members</a>
        <a class="nav-link text-white" href="{{ route('admin.logout') }}">Logout</a>
      </div>
    </div>
  </div>
</nav>

<main class="container my-5">
  <h2 class="text-success text-center mb-4">📋 Event Joining Status</h2>

  <!-- 🔍 Search -->
  <form method="GET" action="{{ route('admin.event.members') }}" class="input-group mb-4">
    <input type="text" name="search" class="form-control" placeholder="Search event title..." value="{{ request('search') }}">
    <button class="btn btn-success" type="submit"><i class="bi bi-search"></i> Search</button>
  </form>

  @forelse($events as $event)
    <div class="card mb-4 shadow-sm">
      <div class="card-header bg-success text-white d-flex justify-content-between">
        <strong>{{ $event->title }}</strong>
        <span>{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}</span>
      </div>
      <div class="card-body">
        @if($event->joinedUsers->count())
          <ul class="list-group">
            @foreach($event->joinedUsers as $user)
              <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $user->name }} ({{ $user->email }})
                <span class="member-badge">Joined</span>
              </li>
            @endforeach
          </ul>
        @else
          <p class="text-muted mb-0">No members have joined this event yet.</p>
        @endif
      </div>
    </div>
  @empty
    <p class="text-muted text-center">No events found.</p>
  @endforelse

  <!-- Pagination -->
  <div class="d-flex justify-content-center mt-4">
    {{ $events->links() }}
  </div>
</main>

<!-- Footer -->
<footer class="bg-success text-white text-center py-3 mt-auto">
  <p class="mb-0">&copy; 2025 Nature Lover Club | Designed by <strong> Iqra Mushtaq</strong></p>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
