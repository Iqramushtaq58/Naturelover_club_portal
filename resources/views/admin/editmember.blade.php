<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Member - Nature Lover Club</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('style.css') }}">

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
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container-fluid">
      <a class="navbar-brand d-flex align-items-center" href="{{ route('admin.dashboard') }}">
        <img src="{{ asset('images/OIP.jpeg') }}" alt="Logo" width="40" height="40" class="me-2 rounded-circle">
        <span>Nature Lover Admin</span>
      </a>
      <div class="navbar-nav ms-auto align-items-center">
        <span class="nav-link text-white">
          Welcome, {{ session('admin_name') }}
          @if(session('admin_role') === 'super_admin')
            <span class="badge bg-warning text-dark ms-1">Super Admin</span>
          @endif
        </span>
        <a class="nav-link text-white" href="{{ route('admin.logout') }}">Logout</a>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <main class="container my-5">
    <h2 class="text-center text-success mb-4">📝 Edit Member Information</h2>

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

    <form action="{{ route('admin.members.update', $member->id) }}" method="POST" enctype="multipart/form-data" class="mx-auto" style="max-width: 600px;">
      @csrf
      <div class="mb-3">
        <label class="form-label">Full Name:</label>
        <input type="text" name="full_name" class="form-control" value="{{ old('full_name', $member->full_name) }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Email:</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $member->email) }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Phone:</label>
        <input type="text" name="phone" class="form-control" value="{{ old('phone', $member->phone) }}">
      </div>

      <div class="mb-3">
        <label class="form-label">Profile Picture:</label><br>
        @if ($member->profile_pic)
          <img src="{{ asset('uploads/' . $member->profile_pic) }}" alt="Current Profile" class="rounded mb-2" width="100">
        @endif
        <input type="file" name="profile_pic" class="form-control">
      </div>

      <button type="submit" class="btn btn-success w-100"><i class="bi bi-save"></i> Update Member</button>
    </form>
  </main>

  <!-- Footer -->
  <footer class="bg-success text-white text-center py-3 mt-auto">
    <p class="mb-0">&copy; 2025 Nature Lover Club - Admin Panel | Designed by <strong> Iqra Mushtaq</strong></p>
  </footer>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
