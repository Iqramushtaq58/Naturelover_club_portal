<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Dashboard - Nature Lover Club</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap & Custom CSS -->
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
    .card-icon {
      font-size: 2.5rem;
      color: #198754;
    }
    .admin-role-badge {
      font-size: 0.8rem;
      background-color: #ffc107;
      color: #000;
      padding: 2px 8px;
      border-radius: 12px;
      margin-left: 8px;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container-fluid">
      <a class="navbar-brand d-flex align-items-center" href="#">
        <img src="{{ asset('images/OIP.jpeg') }}" alt="Logo" width="40" height="40" class="me-2 rounded-circle">
        <span>Nature Lover Admin</span>
      </a>
      <div class="navbar-nav ms-auto align-items-center">
        <span class="nav-link text-white">
          Welcome, {{ session('admin_name') }}
          @if(session('admin_role') === 'super_admin')
            <span class="admin-role-badge">Super Admin</span>
          @endif
        </span>
        <a class="nav-link text-white" href="{{ route('admin.logout') }}">Logout</a>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <main class="container my-5">
    <div class="text-center mb-5">
      <h2 class="text-success">📊 Admin Dashboard</h2>
      <p class="lead">Overview of the Nature Lover Club</p>
    </div>

    <!-- Stats Cards -->
    <div class="row g-4 justify-content-center">
      <div class="col-md-4">
        <div class="card shadow-sm border-success">
          <div class="card-body text-center">
            <i class="bi bi-people-fill card-icon"></i>
            <h5 class="card-title mt-2">Total Members</h5>
            <p class="fs-3 fw-bold text-success">{{ $totalMembers }}</p>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card shadow-sm border-success">
          <div class="card-body text-center">
            <i class="bi bi-calendar-event-fill card-icon"></i>
            <h5 class="card-title mt-2">Total Events</h5>
            <p class="fs-3 fw-bold text-success">{{ $totalEvents }}</p>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card shadow-sm border-success">
          <div class="card-body text-center">
            <i class="bi bi-person-check-fill card-icon"></i>
            <h5 class="card-title mt-2">Joined Events</h5>
            <p class="fs-3 fw-bold text-success">{{ $joinedEvents }}</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Quick Access Buttons -->
    <div class="text-center mt-5">
      <a href="{{ route('admin.members') }}" class="btn btn-outline-success btn-lg me-2 mb-2">
        <i class="bi bi-people"></i> Manage Members
      </a>
      <a href="{{ route('admin.events') }}" class="btn btn-outline-success btn-lg mb-2">
        <i class="bi bi-calendar-week"></i> Manage Events
      </a>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-success text-white text-center py-3 mt-auto">
    <p class="mb-0">&copy; 2025 Nature Lover Club - Admin Panel | Designed by <strong> Iqra Mushtaq</strong></p>
  </footer>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
