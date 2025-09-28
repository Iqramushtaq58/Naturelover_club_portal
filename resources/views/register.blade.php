<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register - Nature Lover Club</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
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
          <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
          <a class="nav-link" href="{{ route('admin.logout') }}">Logout</a>
        @elseif (Auth::check())
          <a class="nav-link" href="/">Home</a>
          <a class="nav-link" href="/about">About</a>
          <a class="nav-link" href="/events">Events</a>
          <a class="nav-link" href="/contact">Contact Us</a>
          <a class="nav-link" href="{{ route('profile.show') }}">Profile</a>
          <form action="{{ route('logout') }}" method="GET" class="d-inline">
            <button type="submit" class="btn btn-link nav-link">Logout</button>
          </form>
        @else
          <a class="nav-link" href="/">Home</a>
          <a class="nav-link" href="/login">Login</a>
          <a class="nav-link active" href="/register">Register</a>
          <a class="nav-link" href="/about">About</a>
          <a class="nav-link" href="/contact">Contact Us</a>
        @endif
      </div>
    </div>
  </div>
</nav>

<!-- Registration Form -->
<div class="container py-5">
  <h2 class="text-center text-success mb-4">Register - Nature Lover Club</h2>

  @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
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

  <form method="POST" action="{{ route('register.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
      <label>Full Name:</label>
      <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
    </div>

    <div class="mb-3">
      <label>Father Name:</label>
      <input type="text" name="father_name" class="form-control" value="{{ old('father_name') }}" required>
    </div>

    <div class="mb-3">
      <label>Student ID:</label>
      <input type="text" name="student_id" class="form-control" value="{{ old('student_id') }}" required>
    </div>

    <div class="mb-3">
      <label>Department:</label>
      <select name="department" class="form-control" required>
        <option value="">Select</option>
        <option value="CS" {{ old('department') == 'CS' ? 'selected' : '' }}>CS</option>
        <option value="SE" {{ old('department') == 'SE' ? 'selected' : '' }}>SE</option>
        <option value="FSN" {{ old('department') == 'FSN' ? 'selected' : '' }}>FSN</option>
        <option value="EE" {{ old('department') == 'EE' ? 'selected' : '' }}>EE</option>
        <option value="BBA" {{ old('department') == 'BBA' ? 'selected' : '' }}>BBA</option>
      </select>
    </div>

    <div class="mb-3">
      <label>CNIC:</label>
      <input type="text" name="cnic" class="form-control" value="{{ old('cnic') }}" required>
    </div>

    <div class="mb-3">
      <label>Phone:</label>
      <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
    </div>

    <div class="mb-3">
      <label>Gender:</label><br>
      <input type="radio" name="gender" value="Male" {{ old('gender') == 'Male' ? 'checked' : '' }} required> Male
      <input type="radio" name="gender" value="Female" {{ old('gender') == 'Female' ? 'checked' : '' }} required> Female
    </div>

    <div class="mb-3">
      <label>Email:</label>
      <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
    </div>

    <div class="mb-3">
      <label>Password:</label>
      <input type="password" name="password" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>Confirm Password:</label>
      <input type="password" name="password_confirmation" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>Profile Picture:</label>
      <input type="file" name="profile_picture" class="form-control">
    </div>

    <button type="submit" class="btn btn-success w-100">Register</button>
  </form>
</div>

<!-- Footer -->
<footer class="bg-success text-white text-center py-3 mt-5">
  <p class="mb-0">&copy; 2025 Nature Lover Club | Designed by <strong> Iqra Mushtaq</strong></p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('script.js') }}"></script>

</body>
</html>
