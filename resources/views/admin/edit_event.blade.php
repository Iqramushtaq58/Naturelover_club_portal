<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Event - Nature Lover Club</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
    .event-img-preview {
      width: 100px;
      height: 70px;
      object-fit: cover;
      border-radius: 6px;
      margin-top: 8px;
    }
  </style>
</head>
<body>

<!-- Admin Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
      <img src="{{ asset('images/OIP.jpeg') }}" width="40" height="40" class="me-2 rounded-circle" alt="Logo">
      Nature Lover
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
  <h2 class="text-center text-success mb-4">✏️ Edit Event</h2>

  @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data" class="card shadow p-4">
    @csrf
    @method('PUT')

    <div class="mb-3">
      <label class="form-label">Event Title</label>
      <input type="text" name="title" class="form-control" value="{{ old('title', $event->title) }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Event Description</label>
      <textarea name="description" class="form-control" required>{{ old('description', $event->description) }}</textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Event Date</label>
      <input type="date" name="event_date" class="form-control" value="{{ old('event_date', $event->event_date) }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Current Image</label><br>
      @if ($event->image)
        <img src="{{ asset('storage/' . $event->image) }}" alt="Event Image" class="event-img-preview">
      @else
        <span class="text-muted">No image uploaded</span>
      @endif
    </div>

    <div class="mb-3">
      <label class="form-label">Change Image (optional)</label>
      <input type="file" name="image" class="form-control">
    </div>

    <button type="submit" class="btn btn-success">Update Event</button>
    <a href="{{ route('admin.events') }}" class="btn btn-secondary">Back to Events</a>
  </form>
</main>

<!-- Footer -->
<footer class="bg-success text-white text-center py-3 mt-auto">
  <p class="mb-0">&copy; 2025 Nature Lover Club | Designed by <strong> Iqra Mushtaq</strong></p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
