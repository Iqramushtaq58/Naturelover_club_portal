<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin - Manage Members</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    html, body {
      height: 100%;
      margin: 0;
    }
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    main {
      flex: 1;
    }
    .member-img {
      width: 40px;
      height: 40px;
      object-fit: cover;
      border-radius: 50%;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-dark bg-success px-3">
    <a class="navbar-brand" href="{{ route('admin.dashboard') }}">← Dashboard</a>
    <span class="navbar-text text-white">Manage Members</span>
  </nav>

  <!-- Main Content -->
  <main class="container my-5">
    <h2 class="text-success text-center mb-4">👥 All Registered Members</h2>

    <!-- Search -->
    <form method="GET" class="d-flex justify-content-end mb-3">
      <input type="text" name="search" class="form-control w-25 me-2" placeholder="Search name/email" value="{{ request('search') }}">
      <button class="btn btn-outline-success">Search</button>
    </form>

    <!-- Members Table -->
    <table class="table table-bordered table-hover">
      <thead class="table-success">
        <tr>
          <th>ID</th>
          <th>Profile</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($members as $member)
        <tr>
          <td>{{ $member->id }}</td>
          <td>
            @if($member->profile_picture && file_exists(public_path('uploads/' . $member->profile_picture)))
              <img src="{{ asset('uploads/' . $member->profile_picture) }}" alt="Profile" class="member-img">
            @else
              <img src="{{ asset('images/default-avatar.png') }}" alt="No Image" class="member-img">
            @endif
          </td>
          <td>{{ $member->name }}</td>
          <td>{{ $member->email }}</td>
          <td>{{ $member->phone }}</td>
          <td>
            <form action="{{ route('admin.members.delete', $member->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Delete this member?')">
              @csrf
              @method('DELETE')
              <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
            </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="6" class="text-center">No members found.</td>
        </tr>
        @endforelse
      </tbody>
    </table>

    {{ $members->links('pagination::bootstrap-5') }}
  </main>

  <!-- Footer -->
  <footer class="bg-success text-white text-center py-3 mt-auto">
    <p class="mb-0">&copy; 2025 Nature Lover Club - Admin Panel | Designed by <strong> Iqra Mushtaq</strong></p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
