<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - Nature Lover Club</title>
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
    <div class="navbar-nav ms-auto">
      <a class="nav-link text-white" href="/">Home</a>
      <a class="nav-link text-white active" href="{{ route('login') }}">Login</a>
      <a class="nav-link text-white" href="{{ route('register') }}">Register</a>
      <a class="nav-link text-white" href="/about">About</a>
      <a class="nav-link text-white" href="/contact">Contact Us</a>
    </div>
  </div>
</nav>

<!-- Login Form -->
<section class="py-5 bg-light" style="min-height: 80vh;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow-sm p-4">
          <h2 class="text-center text-success mb-4">Login</h2>

          @if ($errors->has('login'))
            <div class="alert alert-danger">{{ $errors->first('login') }}</div>
          @endif

          @if ($errors->any() && !$errors->has('login'))
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form action="{{ route('login.submit') }}" method="POST">
            @csrf

            <!-- Role -->
            <div class="mb-3">
              <label for="role" class="form-label">Login As:</label>
              <select name="role" id="role" class="form-select" required>
                <option value="">Select Role</option>
                <option value="member" {{ old('role') === 'member' ? 'selected' : '' }}>Member</option>
                <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>Admin</option>
              </select>
            </div>

            <!-- Email -->
            <div class="mb-3">
              <label for="email" class="form-label">Email:</label>
              <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            </div>

            <!-- Password -->
            <div class="mb-3">
              <label for="password" class="form-label">Password:</label>
              <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success w-100">Login</button>
          </form>

          <div class="text-center mt-3">
            <small>Not a member? <a href="{{ route('register') }}">Register here</a></small>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Footer -->
<footer class="bg-success text-white text-center py-3 mt-auto">
  <p class="mb-0">&copy; 2025 Nature Lover Club | Designed by <strong> Iqra Mushtaq</strong></p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
