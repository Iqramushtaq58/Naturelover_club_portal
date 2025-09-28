<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Events - Nature Lover Club</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('style.css') }}">

  <style>
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    main {
      flex: 1;
    }
    .event-img {
      width: 80px;
      height: 60px;
      object-fit: cover;
      border-radius: 5px;
    }
  </style>
</head>
<body>

<!-- Admin Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center" href="{{ route('admin.dashboard') }}">
      <img src="{{ asset('images/OIP.jpeg') }}" alt="Logo" width="40" height="40" class="me-2 rounded-circle">
      <span>Nature Lover</span>
    </a>
    <div class="navbar-nav ms-auto">
      <a class="nav-link text-white" href="{{ route('admin.dashboard') }}">Dashboard</a>
      <a class="nav-link text-white" href="{{ route('admin.members') }}">Members</a>
      <a class="nav-link text-white active" href="{{ route('admin.events') }}">Events</a>
      <a class="nav-link text-white" href="{{ route('admin.logout') }}">Logout</a>
    </div>
  </div>
</nav>

<!-- Main Content -->
<main class="container my-5">
  <h2 class="text-success text-center mb-4">📅 Club Events</h2>

  @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <!-- Add Event Form -->
  <div class="card shadow mb-4">
    <div class="card-header bg-success text-white">
      <h5 class="mb-0">➕ Add New Event</h5>
    </div>
    <div class="card-body">
      <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
          <label class="form-label">Event Title</label>
          <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
          @error('title') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
          <label class="form-label">Event Description</label>
          <textarea name="description" class="form-control" required>{{ old('description') }}</textarea>
          @error('description') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
          <label class="form-label">Event Date</label>
          <input type="date" name="event_date" class="form-control" value="{{ old('event_date') }}" required>
          @error('event_date') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
          <label class="form-label">Event Image (optional)</label>
          <input type="file" name="image" class="form-control">
          @error('image') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-success">Create Event</button>
      </form>
    </div>
  </div>

  <!-- Event Table -->
  <div class="table-responsive shadow">
    <table class="table table-bordered table-striped">
      <thead class="table-success">
        <tr>
          <th>ID</th>
          <th>Image</th>
          <th>Title</th>
          <th>Description</th>
          <th>Date</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($events as $event)
          <tr>
            <td>{{ $event->id }}</td>
            <td>
              @if ($event->image && file_exists(public_path('uploads/' . $event->image)))
                <img src="{{ asset('uploads/' . $event->image) }}" class="event-img" alt="event image">
              @else
                <span class="text-muted">No Image</span>
              @endif
            </td>
            <td>{{ $event->title }}</td>
            <td>{{ $event->description }}</td>
            <td>{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y') }}</td>
            <td>
              <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-sm btn-primary">
                <i class="bi bi-pencil"></i>
              </a>
              <form action="{{ route('admin.events.delete', $event->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this event?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger">
                  <i class="bi bi-trash"></i>
                </button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" class="text-center text-muted">No events yet.</td>
          </tr>
        @endforelse
      </tbody>
    </table>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-3">
      {{ $events->links() }}
    </div>
  </div>
</main>

<!-- Footer -->
<footer class="bg-success text-white text-center py-3">
  <p class="mb-0">&copy; 2025 Nature Lover Club | Designed by <strong> Iqra Mushtaq</strong></p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
