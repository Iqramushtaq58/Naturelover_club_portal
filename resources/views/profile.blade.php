<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Profile - Nature Lover Club</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('style.css') }}">
  <style>
    .profile-picture-preview {
      width: 150px;
      height: 150px;
      object-fit: cover;
      border-radius: 10px;
      border: 2px solid #ccc;
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
        <a class="nav-link" href="/">Home</a>
        <a class="nav-link" href="/about">About</a>
        <a class="nav-link" href="/events">Events</a>
        <a class="nav-link" href="/contact">Contact Us</a>
        <a class="nav-link active" href="{{ route('profile.show') }}">Profile</a>
        <form action="{{ route('logout.user') }}" method="POST" class="d-inline">
          @csrf
          <button type="submit" class="btn btn-link nav-link">Logout</button>
        </form>
      </div>
    </div>
  </div>
</nav>

<!-- Profile Section -->
<section class="py-5 bg-light">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        @if(session('success'))
          <div class="alert alert-success text-center">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm">
          <div class="card-header bg-success text-white text-center">
            <h4 class="mb-0">My Profile</h4>
          </div>
          <div class="card-body">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')

              <!-- Profile Picture -->
              <div class="mb-4 text-center">
                @php
                  $imagePath = public_path('uploads/' . $user->profile_picture);
                @endphp
                @if ($user->profile_picture && file_exists($imagePath))
                  <img src="{{ asset('uploads/' . $user->profile_picture) }}" class="profile-picture-preview mb-2">
                @else
                  <img src="{{ asset('images/default-avatar.png') }}" class="profile-picture-preview mb-2">
                  <p class="text-muted mt-2">No profile picture uploaded</p>
                @endif
                <input type="file" name="profile_picture" class="form-control mt-2">
                @error('profile_picture')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                @error('name')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <div class="mb-3">
                <label class="form-label">Father Name</label>
                <input type="text" name="father_name" class="form-control" value="{{ old('father_name', $user->father_name) }}" required>
                @error('father_name')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <div class="mb-3">
                <label class="form-label">Student ID</label>
                <input type="text" name="student_id" class="form-control" value="{{ old('student_id', $user->student_id) }}" required>
                @error('student_id')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <div class="mb-3">
                <label class="form-label">Department</label>
                <input type="text" name="department" class="form-control" value="{{ old('department', $user->department) }}" required>
                @error('department')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <div class="mb-3">
                <label class="form-label">CNIC</label>
                <input type="text" name="cnic" class="form-control" value="{{ old('cnic', $user->cnic) }}" required>
                @error('cnic')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <div class="mb-3">
                <label class="form-label">Phone Number</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}" required>
                @error('phone')
                  <small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <div class="mb-3">
                <label class="form-label">Gender</label><br>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" value="Male" {{ $user->gender == 'Male' ? 'checked' : '' }}>
                  <label class="form-check-label">Male</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="gender" value="Female" {{ $user->gender == 'Female' ? 'checked' : '' }}>
                  <label class="form-check-label">Female</label>
                </div>
                @error('gender')
                  <br><small class="text-danger">{{ $message }}</small>
                @enderror
              </div>

              <div class="mb-3">
                <label class="form-label">Email (read-only)</label>
                <input type="email" class="form-control" value="{{ $user->email }}" readonly>
              </div>

              <div class="text-center mt-4">
                <button type="submit" class="btn btn-success">Update Profile</button>
              </div>
            </form>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
